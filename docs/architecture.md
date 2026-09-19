# Payment Infrastructure Architecture

A payment system should separate the customer-facing application, payment orchestration, provider integrations, and internal accounting.

## Reference Flow

`Customer → Checkout → Payment Service → Provider Adapter → Payment Provider → Webhook → Payment Service → Order/Invoice`

Supporting components may include:

- Idempotency store
- Transaction database
- Webhook processor
- Reconciliation worker
- Notification service
- Audit log
- Monitoring and alerting

Never treat a browser redirect alone as proof that a payment succeeded.
