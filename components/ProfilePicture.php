<?php
if (!empty(Prop('name')) && Prop('name') !== 'Okänd användare') {
    $emojis = array(
        'A' => '🙉',
        'B' => '🍌',
        'C' => '🍋',
        'D' => '🐬',
        'E' => '🔥',
        'F' => '🦇',
        'G' => '🐸',
        'H' => '🐹',
        'I' => '🦔',
        'J' => '🃏',
        'K' => '🐣',
        'L' => '🐆',
        'M' => '🥕',
        'N' => '🍜',
        'O' => '🧀',
        'P' => '🌴',
        'Q' => '🦆',
        'R' => '🌹',
        'S' => '🌞',
        'T' => '🐯',
        'U' => '🦄',
        'V' => '🍉',
        'W' => '🥃',
        'X' => '❌',
        'Y' => '🪓',
        'Z' => '🦓',
        'Å' => '⚡',
        'Ä' => '👼',
        'Ö' => '🦎',
    );
    if (isset($emojis[strtoupper(Prop('name')[0])])) {
        $emoji = $emojis[strtoupper(Prop('name')[0])];
    } else {
        $emoji = '❔';
    }
    echo "<span class=\"profilePicture\">$emoji</span>";
}