<?php

/**
 * @apiDefine RoleSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
  "data": {
    "object": "Role",
    "id": 1,
    "name": "praesentium-aut",
    "description": null,
    "display_name": null,
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

