<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #01322F;
            color: white;
            padding: 10px;
            text-align: left;
            width: 100%;
        }

        footer {
            background-color: #01322F;
            color: white;
            padding: 10px;
            text-align: left;
            width: 100%;
            margin-top: auto; /* This pushes the footer to the bottom */
        }

        h3 {
            margin: 5px;
        }
    </style>
</head>
<body>



<!-- Your page content goes here -->

<footer>
    <h3>Privacy Policy</h3>
    <p id="privacy-content">All content included on this site, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of READSPOT or its content suppliers and protected by Sri Lanka and international copyright laws. <span id="read-more" onclick="toggleReadMore()">Read more</span></p>
</footer>

<script>
    let expanded = false;

    function toggleReadMore() {
        const privacyContent = document.getElementById('privacy-content');
        const readMore = document.getElementById('read-more');

        if (expanded) {
            privacyContent.innerHTML = "All content included on this site, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of READSPOT or its content suppliers and protected by Sri Lanka and international copyright laws. Our commitment to fostering a thriving reading community extends beyond mere transactions. We envision a space where literary enthusiasts can explore a vast array of genres, where authors can showcase their creative brilliance, and where readers can embark on transformative literary journeys. READSPOT stands as a beacon, connecting readers to the wealth of human knowledge and imagination. With an unwavering dedication to quality and authenticity, we strive to create an enriching experience for all.";
            readMore.style.display = 'none';
            expanded = false;
        } else {
            privacyContent.innerHTML += " Our commitment to fostering a thriving reading community extends beyond mere transactions. We envision a space where literary enthusiasts can explore a vast array of genres, where authors can showcase their creative brilliance, and where readers can embark on transformative literary journeys. READSPOT stands as a beacon, connecting readers to the wealth of human knowledge and imagination. With an unwavering dedication to quality and authenticity, we strive to create an enriching experience for all.";
            expanded = true;
        }
    }
</script>

</body>
</html>