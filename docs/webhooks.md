# Webhooks

Webhooks are asynchronous provider notifications.

## Verification

Where supported:

- Verify the provider signature.
- Validate timestamp/replay protection.
- Validate event identifiers.
- Store the event before processing.
- Make event handling idempotent.
- Return an appropriate response quickly.
- Process expensive work asynchronously.

Never trust amount, currency, customer, or transaction identifiers solely because they arrived in an unauthenticated request.
