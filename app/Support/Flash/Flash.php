<?php

declare(strict_types=1);

namespace App\Support\Flash;

use Illuminate\Contracts\Session\Session;

final class Flash
{
    private const MESSAGE_KEY = 'flash';

    private const TYPE = 'flash_type';

    public function __construct(
        private readonly Session $session
    ) {
    }

    public function get(): ?Message
    {
        $message = $this->session->get(self::MESSAGE_KEY);

        if (!$message) {
            return null;
        }

        $flashType = FlashTypes::tryFrom($this->session->get(self::TYPE))
            ?? FlashTypes::INFO;

        return new Message(
            $message,
            $flashType
        );
    }

    public function type(): string
    {
        $type = $this->session->get(self::TYPE);

        if (!$type) {
            return FlashTypes::INFO->value;
        }

        return $type;
    }

    public function info(string $message): void
    {
        $this->flash($message, FlashTypes::INFO);
    }

    public function success(string $message): void
    {
        $this->flash($message, FlashTypes::SUCCESS);
    }

    public function warning(string $message): void
    {
        $this->flash($message, FlashTypes::WARNING);
    }

    public function danger(string $message): void
    {
        $this->flash($message, FlashTypes::DANGER);
    }

    private function flash(string $message, FlashTypes $types): void
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::TYPE, $types->value);
    }
}
