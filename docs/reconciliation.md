# Reconciliation

Reconciliation compares internal records with provider state.

Useful checks include:

- Payment status
- Amount
- Currency
- Provider transaction ID
- Refund status
- Settlement information

A reconciliation job should identify mismatches rather than silently overwriting records.

Example:

`Internal Pending + Provider Succeeded → Reconciliation Review/Update`

Keep an audit trail for automated corrections.
