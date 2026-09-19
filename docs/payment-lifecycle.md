# Payment Lifecycle

A generic lifecycle is:

`Created → Pending → Authorized → Captured → Succeeded`

Other states may include:

- Failed
- Cancelled
- Expired
- Refunded
- Partially refunded
- Disputed

The exact states depend on the provider.

Persist provider transaction identifiers and maintain an internal state model independent of provider-specific naming.
