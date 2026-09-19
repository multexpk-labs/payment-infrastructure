# Blockchain Confirmation Strategy

A blockchain payment should move through explicit verification states.

Example:

`Detected → Validating → Confirming → Confirmed → Settled`

## Validation

Verify:

- Network
- Token contract/asset where applicable
- Destination
- Amount
- Transaction identifier
- Block inclusion
- Confirmation count

## Confirmation Policy

MULTEXPK's documented operational policy uses **12 confirmations** before final settlement for the relevant payment workflow.

The exact number should be configurable because confirmation behavior, network conditions, risk tolerance, and asset characteristics differ.

## Timeouts

If the expected confirmation window is exceeded:

1. Keep the payment in a non-final state.
2. Continue monitoring when appropriate.
3. Record the latest blockchain/provider observation.
4. Alert or queue for review when required.
5. Do not create a second payment record for the same transaction.

## Duplicate Protection

Use a unique transaction identifier plus network/asset context. A transaction must not be credited to multiple invoices.

## Reorganizations and Provider Disagreement

Where the underlying network/provider can expose changing confirmation or transaction state, retain enough evidence to reconcile the final result rather than assuming the first observation is immutable.
