<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Results</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(https://w0.peakpx.com/wallpaper/470/534/HD-wallpaper-anime-school-book-school-desk-anime.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .result-container {
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        
    </style>
</head>

<body>
    <div class="container">
        <div class="result-container col-md-6">
            <h2>Evaluation Results</h2>
            <?php
            $faculty_name = $_POST['faculty_name'];
            $teaching_skills = $_POST['teaching_skills'];
            $communication = $_POST['communication'];
            $knowledge = $_POST['knowledge'];
            $feedback = $_POST['feedback'];

            // Calculate average rating
            $average_rating = ($teaching_skills + $communication + $knowledge) / 3;

            // Display results
            echo "<p>Faculty Name: $faculty_name</p>";
            echo "<p>Average Rating: $average_rating</p>";
            echo "<p>Feedback: $feedback</p>";
            ?>
        </div>
    </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>