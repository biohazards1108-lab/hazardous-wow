<?php
// Replace with your specific Bug Report channel webhook
$bug_webhook = "https://discord.com/api/webhooks/1476634364090519622/xcPFqB7Qg3Mip--zu_Y0iYsCbJ6XTsj7Q5AVKPSmestbsuBPFdFfG1zjy-tVtsT4N9XY"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $char_name = $_POST['char_name'] ?? 'Anonymous';
    $category = $_POST['category'] ?? 'General';
    $description = $_POST['bug_desc'] ?? 'No details provided';

    $data = [
        "content" => "🪲 **New Bug Report Submitted**",
        "embeds" => [[
            "title" => "Technical Issue: " . $category,
            "color" => 15158332, // Red color
            "fields" => [
                ["name" => "Reporting Player", "value" => $char_name, "inline" => true],
                ["name" => "Category", "value" => $category, "inline" => true],
                ["name" => "Issue Description", "value" => $description, "inline" => false]
            ],
            "footer" => ["text" => "Hazardous Bug Tracker"]
        ]]
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    @file_get_contents($bug_webhook, false, $context);

    header("Location: index.php?report=success");
    exit();
}
?>
