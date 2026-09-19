# Payment Infrastructure Tests

Public tests should use synthetic transactions and provider mocks.

## Minimum Test Matrix

- Valid and invalid amounts
- Currency handling
- Idempotency keys
- Provider success/failure/timeout responses
- Payment state transitions
- Webhook authentication
- Duplicate and out-of-order webhooks
- Refund state changes
- Reconciliation mismatches
- Authorization boundaries

Keep real credentials and real payment data outside source control and CI.
