<?php declare(strict_types=1);

namespace App\Infrastructure\Controller\Identity;

use JsonSerializable;

final class Result implements JsonSerializable
{
    private const RESULT_KEY = 'result';
    private const MSG_KEY = 'msg';
    private const DATA_KEY = 'data';

    private bool $success;
    private array $msgList;
    private ?array $resultData;

    public static function success($data = null, $msg = null): self
    {
        return new self(true, $msg, $data);
    }

    public static function fails($msg = null, $data = null): self
    {
        return new self(false, $msg, $data);
    }

    /**
     * @param array|mixed  $msg
     * @param mixed        $data
     */
    public function __construct(bool $success = true, $msg = null, $data = null)
    {
        $this->success = $success;
        $this->resultData = $data;
        $this->msgList = [];

        if (is_array($msg)) {
            $this->msgList = $msg;
        }
        else if (is_string($msg)) {
            $this->msgList = [$msg];
        }
    }

    public function jsonSerialize()
    {
        return [
            self::RESULT_KEY => $this->success,
            self::MSG_KEY => $this->msgList,
            self::DATA_KEY => $this->resultData,
        ];
    }
}