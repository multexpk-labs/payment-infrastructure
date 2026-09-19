#!/usr/bin/env python3
import json
import uuid
from datetime import datetime, timezone

fixture = {
    "payment_id": str(uuid.uuid4()),
    "order_id": "example-order-001",
    "amount": "49.99",
    "currency": "USD",
    "status": "pending",
    "idempotency_key": "example-idempotency-key",
    "created_at": datetime.now(timezone.utc).isoformat(),
}

print(json.dumps(fixture, indent=2))
