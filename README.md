# Payment Infrastructure

Engineering patterns for payment gateways, transaction workflows, provider integrations, blockchain payments, webhooks, reconciliation, security, and reliable payment operations.

## Scope

This repository studies the engineering around payment systems:

- Checkout and payment APIs
- WHMCS payment-gateway integration
- Self-hosted crypto payment workflows
- USDT TRC20 and BEP20 payment handling
- Provider/API integrations
- Transaction state machines
- Idempotency
- Blockchain confirmation monitoring
- Webhooks
- Refunds and reconciliation
- Notifications
- Audit trails
- Security
- Testing and operational monitoring

## MULTEXPK Pay Gateway

MULTEXPK has used **pay.multex.pk** as a self-hosted payment workflow integrated with WHMCS.

The crypto-payment implementation was built around direct blockchain settlement rather than routing every transaction through a percentage-based third-party crypto gateway.

The documented deployment supports **USDT TRC20 and USDT BEP20**, with the exact production configuration treated as authoritative.

See [MULTEXPK crypto gateway](docs/multexpk-crypto-gateway.md).

## WHMCS + Boxcoin Customization

The implementation used the publicly listed **Boxcoin** WHMCS cryptocurrency module as a starting point and customized it for MULTEXPK requirements.

The WHMCS Marketplace currently lists Boxcoin as a free cryptocurrency payment gateway. citeturn0search1

The customized workflow covers payment instructions, transaction monitoring, confirmation rules, automatic invoice settlement, duplicate protection, and reconciliation. Third-party source is not reproduced here; licensing and redistribution terms must be checked before publishing modified source.

See [Boxcoin customization](docs/boxcoin-customization.md).

## Blockchain Verification

Conceptual flow:

`WHMCS Invoice → pay.multex.pk → Customer Blockchain Payment → Transaction Monitoring → Validation → Confirmation Threshold → WHMCS Invoice Paid → Provisioning`

The verification layer should independently confirm:

- Network
- Asset/token
- Destination
- Amount
- Transaction ID
- Block inclusion
- Required confirmations
- Invoice association
- Duplicate transaction protection

For the MULTEXPK deployment, the operational policy uses **12 confirmations** before final settlement, with monitoring designed around a target of approximately one hour. These are deployment policy values, not universal blockchain guarantees.

See [blockchain confirmation strategy](docs/blockchain-confirmation.md).

## Binance API Integration

The deployment uses Binance-related API integration as part of the payment monitoring/verification workflow.

The architecture separates:

1. Invoice creation
2. Payment instructions
3. Blockchain observation
4. Transaction validation
5. Confirmation counting
6. Idempotent invoice settlement
7. Provisioning

A customer-submitted transaction hash is never sufficient by itself to mark an invoice paid.

## Network Fees

Blockchain transactions have network-specific costs.

For the MULTEXPK operating model, USDT TRC20 transactions have been handled with transaction costs reported at approximately **US$1 per transaction under the applicable conditions**, rather than a 3–6% percentage-based gateway charge.

This is an operational cost observation, not a guaranteed network fee. Actual fees vary by network conditions, transaction mechanics, and wallet/provider configuration.

The engineering objective is to keep payment processing costs transparent while retaining responsibility for wallet security, monitoring, reconciliation, and compliance.

## Reference Architecture

`Customer → Checkout → Payment Service → Provider/Blockchain Adapter → Payment Network → Verification → Order/Invoice`

A browser redirect is not sufficient evidence that a payment succeeded. The backend should independently verify provider or blockchain state.

## Payment Lifecycle

A generic lifecycle is:

`Created → Pending → Authorized/Observed → Confirming → Succeeded/Settled`

Additional states may include failed, cancelled, expired, refunded, partially refunded, or disputed.

Provider and blockchain terminology differs, so maintain an internal state model and map external states into it.

## Idempotency

Payment requests must tolerate retries from clients, networks, workers, and providers.

Use durable idempotency keys and unique transaction/network/asset combinations where appropriate.

For ambiguous outcomes, reconcile external state before attempting another charge or credit.

## Webhooks

Treat webhooks as untrusted external input until authenticated.

Recommended flow:

`Receive → Verify Signature → Validate Event → Deduplicate → Persist → Queue → Process → Acknowledge`

Where supported, implement replay protection and preserve the provider event ID.

## Reconciliation

Compare:

`WHMCS Transactions ↔ Internal Payment Records ↔ Provider/Blockchain Data`

Mismatches should be visible and auditable rather than silently overwritten.

## Security

Apply:

- TLS
- Strong authentication and authorization
- Secret management
- Webhook signature verification
- Replay protection
- Idempotency
- Input validation
- Rate limiting
- Audit logging
- Minimal access to payment data
- Secure error handling

Never commit wallet private keys, seed phrases, API keys, Binance credentials, webhook secrets, card data, CVV/CVC, or customer payment information.

## Testing

Public CI should use synthetic transactions, provider mocks, fixtures, sandbox APIs, and deterministic state transitions.

Recommended coverage includes payment validation, idempotency, provider responses, blockchain confirmation logic, duplicate/out-of-order events, refunds, reconciliation, authorization, and timeout handling.

## Practical Resources

- `bash/payment-env-check.sh` — environment diagnostics
- `python/payment_fixture.py` — synthetic transaction fixture
- `php/PaymentStateMachine.php` — generic state-machine example
- `examples/webhook.json` — synthetic webhook fixture
- `examples/payment-verification.json` — synthetic blockchain verification fixture
- `tests/README.md` — testing matrix

These examples contain no real credentials, wallet addresses, or customer payment data.

## Research & Reimplementation

**Find → Clone → Inspect → Understand → Document → Reimplement → Test → Improve**

Study public payment implementations for architecture and behavior. Check licenses before reuse and preserve required notices. Do not copy proprietary payment code or expose real transaction data.

## Related Repositories

- [whmcs-engineering](https://github.com/multexpk-labs/whmcs-engineering)
- [hosting-platform-engineering](https://github.com/multexpk-labs/hosting-platform-engineering)
- [database-backend-engineering](https://github.com/multexpk-labs/database-backend-engineering)
- [php-laravel-engineering](https://github.com/multexpk-labs/php-laravel-engineering)
- [vps-provisioning](https://github.com/multexpk-labs/vps-provisioning)

---

## MULTEXPK LABS

**Zain Ul Abddin — Founder, MULTEXPK LTD ®™**

Technical education, payment/infrastructure engineering, AI/LLM research, automation, and practical software development.

**MULTEXPK LTD ®™ – Secure Cloud • VPS • Hosting • Automation**

https://multexpk.com | https://webvpsserver.com | WhatsApp: +92 312 6565434 | support@multexpk.com