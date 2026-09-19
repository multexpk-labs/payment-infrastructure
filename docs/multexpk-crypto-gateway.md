# MULTEXPK Crypto Payment Gateway

## Pay.MULTEXPK

MULTEXPK operates a self-hosted payment workflow at **pay.multex.pk** for cryptocurrency payments integrated with the billing system.

The public architecture documented here is intentionally high-level. Private wallet addresses, API credentials, webhook secrets, customer transaction records, and production infrastructure are not published.

## Payment Model

The implementation was designed around direct blockchain settlement rather than routing payments through a percentage-based third-party crypto processor.

Supported networks in the documented deployment include:

- **USDT TRC20**
- **USDT BEP20**

The exact supported assets/networks should always be validated against the current production configuration before accepting a payment.

## WHMCS Integration

The workflow began with the public **Boxcoin** WHMCS payment module and was customized for MULTEXPK's operational requirements.

The WHMCS Marketplace currently lists Boxcoin as a cryptocurrency payment gateway. The MULTEXPK implementation should be treated as a customized deployment, not as an assertion that the public marketplace package contains the private modifications used by MULTEXPK.

## Verification Workflow

Conceptually:

`WHMCS Invoice → Payment Page → Network/Amount Instructions → Blockchain Transaction → Confirmation Monitoring → Verification → WHMCS Invoice Paid → Provisioning`

The verification layer should confirm:

- Correct network
- Correct destination address
- Correct token/asset
- Correct amount
- Transaction identity
- Required confirmation depth
- Invoice/payment association
- Duplicate transaction protection

For the MULTEXPK deployment, the operational policy described by the engineering team uses **12 confirmations** before treating a blockchain payment as sufficiently confirmed, with monitoring designed around a target confirmation window of approximately one hour. These are deployment policy values, not universal blockchain guarantees.

## Binance API / Blockchain Monitoring

The deployment uses Binance-related API integration as part of the payment monitoring/verification workflow.

The important engineering principle is to separate:

1. Invoice creation
2. Payment instructions
3. Blockchain observation
4. Transaction validation
5. Confirmation counting
6. Idempotent invoice settlement
7. Provisioning

Never mark an invoice paid merely because a customer submits a transaction hash.

## Gas / Network Fee Management

Blockchain payments have network-specific transaction costs.

MULTEXPK's deployment includes operational handling for transaction/gas-fee considerations, including USDT TRC20 settlement.

The reported operating model for this deployment is that USDT TRC20 transaction costs can be around **US$1 per transaction under the applicable conditions**, rather than paying a percentage-based crypto gateway processing fee. Actual blockchain/network costs are variable and should be measured from the live transaction rather than hard-coded.

## Why Self-Hosted?

A direct/self-hosted model can provide:

- Control over the checkout flow
- Direct settlement to merchant-controlled addresses
- Custom WHMCS automation
- Custom confirmation policy
- Custom reconciliation
- Reduced dependency on third-party payment processors

It also transfers more responsibility to the merchant for wallet security, blockchain monitoring, reconciliation, fraud controls, operational recovery, and regulatory/compliance requirements.

## Security Boundary

Never publish:

- Wallet private keys
- Seed phrases
- API secrets
- Binance credentials
- Webhook signing secrets
- Customer transaction records
- Internal wallet inventories
- Production database credentials

Use environment variables or a dedicated secret-management system.

## Reconciliation

A production implementation should periodically reconcile:

`WHMCS Transactions ↔ Internal Payment Records ↔ Blockchain/Provider Data`

Any mismatch should be recorded for investigation instead of silently rewriting financial history.
