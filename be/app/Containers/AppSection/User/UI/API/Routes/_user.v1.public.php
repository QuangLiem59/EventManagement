<?php

/**
 * @apiDefine UserSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
  "data": {
    "object": "User",
    "id": 1,
    "name": "Admin",
    "username": "admin",
    "email": "admin@admin.com",
    "phone": "0909xxxxxx",
    "gender": "male",
    "birthday": "1990-01-01",
    "avatar": "/storage/avatar.jpg",
    "address": "Cần Thơ",
    "status": "enable"
  },
  "meta": {
    "include": [
      "roles",
      "permissions"
    ],
    "custom": []
  }
}
*/

