<?php

namespace App\Containers\AppSection\Notification\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Notification\UI\API\Requests\GetAllNotificationsRequest;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Notifications\DefaultNotification;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Actions\Action as ParentAction;
use Exception;
use Illuminate\Support\Arr;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllNotificationsAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllNotificationsRequest $request): mixed
    {
        $include = $request->query('include', []);
        if (!empty($include)) {
            $include = explode(',', $include);
        }

        $limit = $request->query('limit', config('repository.pagination.limit'));
        $status = $request->query('status');
        $type = $request->query('type');

        $user = $request->user();

        $notifications = $user->notifications();
        if ($status == 'read') {
            $notifications->whereNotNull('read_at');
        } elseif ($status == 'unread') {
            $notifications->whereNull('read_at');
        }

        if ($type == 'default') {
            $type = DefaultNotification::class;
        }

        if ($type) {
            $notifications->where('type', $type);
        }

        $data = $notifications->paginate($limit);

        $list = [];
        foreach ($data->items() as $notification) {
            $item = [
                'id' => $notification->id,
                'type' => $notification->data['type'],
                'title' => $notification->data['title'],
                'message' => $notification->data['message'],
                'data' => Arr::get($notification->data, 'data'),
                'read' => $notification->read_at,
                'time' => $notification->created_at,
            ];

            if ($item['data'] AND !empty($include)) {
                if (in_array('user', $include)) {
                    $userId = Arr::get($item['data'], 'userId', 0);
                    $item['user'] = null;

                    try {
                        $user = UserRepository::instance()->find($userId);
                        $item['user'] = [
                            'data' => app(UserTransformer::class)->transform($user)
                        ];
                    } catch (Exception) {}
                }
            }

            $list[] = $item;
        }
        
        $prevPage = $data->previousPageUrl();
        $nextPage = $data->nextPageUrl();

        $links = [];
        if ($prevPage) {
            $links['previous'] = $prevPage;
        }

        if ($nextPage) {
            $links['next'] = $nextPage;
        }
        
        return [
            'data' => $list,
            'meta' => [
                'include' => [
                    'user',
                ],
                'custom' => [],
                'pagination' => [
                    'total' => $data->total(),
                    'count' => count($list),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'total_pages' => $data->lastPage(),
                    'links' => $links
                ]
            ]
        ];
    }
}
