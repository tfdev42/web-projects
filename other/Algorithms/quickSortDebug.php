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
            echo "Inserting ", $arr[$i], " into left array<br>";
            $left[] = $arr[$i];
        } else {
            echo "Inserting ", $arr[$i], " into right array<br>";
            $right[] = $arr[$i];
        }
    }

    echo "Pivot: $pivot\n";

    return array_merge(quickSortRightPivot($left), [$pivot], quickSortRightPivot($right));
}

// Example usage

$unsortedArray = [64, 34, 25, 12, 22, 11, 90];
echo "Unsorted array: " . implode(", ", $unsortedArray) . "<br>";

$sortedArray = quickSortRightPivot($unsortedArray);
echo "Sorted array using Quick Sort (rightmost pivot): " . implode(", ", $sortedArray) . "<br>";
?>
