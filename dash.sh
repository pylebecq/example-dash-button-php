#!/usr/bin/env bash
curl \
-v \
-X POST \
-H 'Accept: application/json' \
-H 'X-User-Id: 1' \
-H 'Content-Type: application/json' \
--data '{"product_id": 1, "quantity": 1}' \
http://localhost:8000/api/dash/order
