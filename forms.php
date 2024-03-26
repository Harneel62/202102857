<!--
  #name: Harneel kaur
  #id: 202102857
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Elements</title>
  <link rel="stylesheet" href="css/form_style.css">
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include('nav.php') ?>
  <div class="container">
    <h1>Form Elements</h1>
    <form>
      <label for="name">Name: (Text Input)</label>
      <input type="text" id="name" name="name" required>
      <br>
      <label for="number">Number: (Number Input)</label>
      <input type="number" id="number" name="number" required>
      <br>
      <label for="email">Email: (Email Input)</label>
      <input type="email" id="email" name="email" required>
      <br>
      <label for="password">Password: (Password Input)</label>
      <input type="password" id="password" name="password" required>
      <br>
      <label for="dob">Date of Birth: (Date Input)</label>
      <input type="date" id="dob" name="dob" required>
      <br>
      <label for="gender">Gender: (Select Dropdown)</label>
      <select id="gender" name="gender" required>
        <option value="">Select...</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>
      <br>
      <label for="terms">Accept Terms and Conditions: (Checkbox)</label>
      <input type="checkbox" id="terms" name="terms" required>
      <br>
      <label for="courses">Select Courses: (Multi-select Dropdown)</label>
      <select id="courses" name="courses" required>
        <option value="html">HTML</option>
        <option value="css">CSS</option>
        <option value="js">JavaScript</option>
        <option value="react">React</option>
        <option value="node">Node.js</option>
      </select>
      <br>
      <label for="message">Message: (Textarea)</label>
      <textarea id="message" name="message" rows="4" cols="50" required></textarea>
      <br>
      <label for="file">File: (File Input)</label>
      <input type="file" id="file" name="file" accept=".txt, .pdf" required>
      <br>
      <label for="color">Color: (Color Input)</label>
      <input type="color" id="color" name="color" value="#ffffff" required>
      <br>
      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>
