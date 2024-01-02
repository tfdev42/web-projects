<?php

declare(strict_types=1);

function display_payment_method() {
    // <!-- Display payment option field only for customers -->
    ?> <label>
        Payment Option:
        <select name="payment_option">
            <option value="bill">Bill</option>
            <option value="IBAN">IBAN</option>
        </select>
    </label>
    <?php }