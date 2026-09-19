# Payment Testing

Payment systems need deterministic tests for both successful and ambiguous outcomes.

## Recommended Coverage

- Payment request validation
- Amount/currency validation
- Idempotency
- Provider response mapping
- Timeout handling
- Retry behavior
- Webhook signature verification
- Duplicate webhook delivery
- Out-of-order events
- Refund flows
- Reconciliation
- Authorization
- Audit logging

Use provider sandbox APIs, mocks, and synthetic fixtures. Never use real customer payment data in public CI.
