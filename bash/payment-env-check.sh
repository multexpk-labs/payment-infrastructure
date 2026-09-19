#!/usr/bin/env bash
set -u

echo "== Payment Environment Check =="
echo "Time: $(date -Is)"
echo "Host: $(hostname)"
echo "Kernel: $(uname -sr)"
echo "--- PHP ---"
php -v 2>/dev/null | head -n 1 || true
echo "--- Disk ---"
df -h / 2>/dev/null || true
echo "--- Network listeners ---"
ss -lnt 2>/dev/null || true
