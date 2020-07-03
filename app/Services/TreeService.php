<?php

namespace App\Services;

/**
 * Class TreeService
 * @package App\Services
 */
class TreeService
{
    /**
     * @param array $items
     * @param null $parentId
     * @return array
     */
    public function buildTree(array $items, $parentId = null): array
    {
        $tree = [];

        foreach ($items as $item) {
            if ($item['parent_id'] == $parentId) {
                $children = $this->buildTree($items, $item['id']);
                if ($children) {
                    $item['children'] = $children;
                }
                $tree[] = $item;
            }
        }

        return $tree;
    }

    /**
     * @param array $tree
     * @return int
     */
    public function calculateValueOfTree(array $tree): int
    {
        static $result = 0;
        foreach ($tree as $item) {
            if (isset($item['children'])) {
                $this->calculateValueOfTree($item['children']);
            }
            $result += $item['value'];
        }

        return $result;
    }
}
