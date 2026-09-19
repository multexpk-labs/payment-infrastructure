# Boxcoin Customization & WHMCS Integration

The MULTEXPK payment workflow used the public Boxcoin WHMCS module as a starting point and customized the integration for internal requirements.

The WHMCS Marketplace lists Boxcoin under Payment Gateways as a free cryptocurrency payment module. See the marketplace listing before studying or redistributing any source.

## Customization Areas

The engineering concerns for a customized deployment include:

- Invoice-specific payment instructions
- Supported network selection
- USDT amount calculation
- Transaction monitoring
- Confirmation thresholds
- Duplicate transaction prevention
- WHMCS transaction recording
- Automatic invoice settlement
- Provisioning after confirmed payment
- Error/retry handling
- Reconciliation
- Customer-facing payment status

## Important Principle

A payment module should not trust a client-provided transaction hash as proof of payment.

The backend must independently verify the transaction and map it to the intended invoice.

## Licensing

Before publishing modified Boxcoin source code, inspect the license and current distribution terms. This repository documents architecture and engineering patterns; it does not publish proprietary or third-party source code merely because it was used as a starting point.
