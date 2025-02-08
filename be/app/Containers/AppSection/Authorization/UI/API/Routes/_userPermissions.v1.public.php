<?php

/**
 * @apiDefine UserPermissionsSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
  "data": {
    "object": "User",
    "id": 1,
    "name": "Ali Kazmi",
    "code": "NV01",
    "email": "ali@kazmi.me",
    "gender": "male",
    "birthday": "2022-02-02",
    "avatar": null,
    "id_card": null,
    "id_card_date": null,
    "id_card_place": null,
    "phone": null,
    "zalo": null,
    "facebook": null,
    "address": null,
    "position": null,
    "start_date": null,
    "marital_status": null,
    "profile_status": null,
    "status": "enable",
    "created_at": "2022-06-14T06:19:18.000000Z",
    "updated_at": "2022-06-14T06:25:00.000000Z",
    "permissions": {
      "data": [
        {
          "object": "Permission",
          "id": 1,
          "name": "est-sit-voluptatem",
          "description": null,
          "display_name": null
        },
        {
          "object": "Permission",
          "id": 2,
          "name": "something-else",
          "description": null,
          "display_name": null
        }
      ]
    }
  },
  "meta": {
    "include": [
    ],
    "custom": [
    ]
  }
}
 */

