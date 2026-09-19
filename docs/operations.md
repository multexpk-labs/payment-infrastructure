# Payment Operations

Monitor:

- Payment success/failure rates
- Provider API latency
- Timeout rates
- Webhook delivery failures
- Queue depth
- Reconciliation mismatches
- Refund failures
- Duplicate-operation attempts

Operational workflow:

**Detect → Correlate → Verify Provider State → Reconcile → Notify → Document**

When provider state is ambiguous, do not blindly retry a charge. Query or reconcile the provider first when the API supports it.
