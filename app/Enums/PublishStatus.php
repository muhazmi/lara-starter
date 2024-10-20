<?php

namespace App\Enums;

enum PublishStatus
{
    const DRAFT = 1;
    const PUBLISHED = 2;

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function map(): array
    {
        return [
            static::DRAFT => __('Draft'),
            static::PUBLISHED => __('Published'),
        ];
    }

    /**
     * Retrieve the description for a given status.
     *
     * @param int $status
     * @return string|null
     */
    public static function getDescription(int $status): ?string
    {
        return self::map()[$status] ?? null;
    }

    public static function getClassBootstrap(int $status): ?string
    {
        $classes = [
            static::DRAFT => 'btn btn-secondary',
            static::PUBLISHED => 'btn btn-success',
        ];

        return $classes[$status] ?? null;
    }

    public static function getIcon(int $status): ?string
    {
        $classes = [
            static::DRAFT => '<i class="fa fa-file-pen"></i>',
            static::PUBLISHED => '<i class="fa fa-check"></i>',
        ];

        return $classes[$status] ?? null;
    }
}
