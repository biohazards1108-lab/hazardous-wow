<?php
$webhook_url = "YOUR_DISCORD_WEBHOOK_URL_HERE";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['item_name'] ?? 'Unknown Item';
    $description = $_POST['description'] ?? 'No description provided';

    $data = [
        "content" => "⚒️ **New Custom Gear Request!**",
        "embeds" => [[
            "title" => "Blacksmith Order",
            "color" => 12886874, // Gold color
            "fields" => [
                ["name" => "Item Name", "value" => $itemName, "inline" => false],
                ["name" => "Stats/Description", "value" => $description, "inline" => false]
            ],
            "footer" => ["text" => "Hazardous Forge"]
        ]]
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    file_get_contents($webhook_url, false, $context);

    header("Location: index.php?status=sent");
    exit();
}
?>
