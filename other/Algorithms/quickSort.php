<?php
function quickSortRightPivot($arr) {
    $n = count($arr);

    if ($n <= 1) {
        return $arr;
    }

    $pivot = $arr[$n - 1]; // Choose the rightmost element as the pivot
    $left = $right = [];

    for ($i = 0; $i < $n - 1; $i++) {
        if ($arr[$i] < $pivot) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }

    return array_merge(quickSortRightPivot($left), [$pivot], quickSortRightPivot($right));
}

// Example usage
$unsortedArray = [64, 34, 25, 12, 22, 11, 90];
$sortedArray = quickSortRightPivot($unsortedArray);

echo "Sorted array using Quick Sort (rightmost pivot): " . implode(", ", $sortedArray);
?>

