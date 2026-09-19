<?php

declare(strict_types=1);

final class PaymentStateMachine
{
    private const TERMINAL = ['succeeded', 'failed', 'cancelled', 'refunded'];

    public function transition(string $current, string $next): string
    {
        if (in_array($current, self::TERMINAL, true)) {
            throw new LogicException("Terminal payment cannot transition: {$current}");
        }

        $allowed = [
            'created' => ['pending', 'cancelled'],
            'pending' => ['authorized', 'succeeded', 'failed', 'cancelled'],
            'authorized' => ['succeeded', 'failed', 'cancelled'],
        ];

        if (!in_array($next, $allowed[$current] ?? [], true)) {
            throw new InvalidArgumentException("Invalid transition {$current} -> {$next}");
        }

        return $next;
    }
}
