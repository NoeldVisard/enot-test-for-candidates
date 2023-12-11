<?php

namespace app\core;

abstract class Model
{
    private int $id;

    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}