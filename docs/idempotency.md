# Idempotency

Payment operations must tolerate retries.

Use a unique idempotency key for operations such as payment creation or capture.

A safe pattern is:

1. Receive request.
2. Validate the key and request parameters.
3. Check for an existing operation.
4. Return the existing result when the same operation already succeeded.
5. Create the operation atomically when it does not exist.
6. Store the provider reference.
7. Reconcile ambiguous outcomes.

Idempotency prevents duplicate charges when clients, proxies, workers, or providers retry requests.
