# GearRatios

To solve this problem I decided to work with a string and an offset corresponding to the number of items per line.
This way we can check the positions adjacent to the items using the following formulas:


<table>
    <tr>
        <th>Position</th>
        <th>How to access using array</th>
        <th>How to access using string</th>
    </tr>
    <tr>
        <td>Left</td>
        <td>$line, $column - 1</td>
        <td>$index - 1</td>
    </tr>
    <tr>
        <td>Right</td>
        <td>$line, $column + 1</td>
        <td>$index + 1</td>
    </tr>
    <tr>
        <td>Top</td>
        <td>$line - 1, $column</td>
        <td>$index - $offset</td>
    </tr>
    <tr>
        <td>Bottom</td>
        <td>$line + 1, $column</td>
        <td>$index + $offset</td>
    </tr>
    <tr>
        <td>Top left</td>
        <td>$line - 1, $column - 1</td>
        <td>$index - $offset - 1</td>
    </tr>
    <tr>
        <td>Top Right</td>
        <td>$line - 1, $column + 1</td>
        <td>$index - $offset + 1</td>
    </tr>
    <tr>
        <td>Bottom left</td>
        <td>$line + 1, $column - 1</td>
        <td>$index + $offset - 1</td>
    </tr>
    <tr>
        <td>Bottom right</td>
        <td>$line + 1, $column + 1</td>
        <td>$index + $offset + 1</td>
    </tr>
</table>

Where offset is the quantity of columns and index is the current position of the number that we are checking.