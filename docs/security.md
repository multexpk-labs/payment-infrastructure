# Payment Security

Payment systems require strict security boundaries.

## Controls

- TLS for transport
- Strong authentication
- Authorization checks
- Secret management
- Webhook signature verification
- Replay protection
- Idempotency
- Input validation
- Rate limiting
- Audit logging
- Minimal access to payment data
- Secure error handling

Do not log full card numbers, CVV/CVC, authentication secrets, API tokens, or sensitive customer information.

Where possible, use provider-hosted/tokenized payment methods so sensitive payment data does not pass through your application.
