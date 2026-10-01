<?php
include("config/db.php");

// Handle Contact Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic validation / sanitization
    // We don't strictly need mysqli_real_escape_string for prepared statements, but good to have if we were doing other logging.
    // For prepared statements, we bind parameters.

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (name, email, phone, gender, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $phone, $gender, $subject, $message);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Message sent successfully!');</script>";
        } else {
             // Use error details for debugging (in production, log this instead of echoing)
             // echo "ERROR: Could not execute query: " . mysqli_stmt_error($stmt);
            echo "<script>alert('Error sending message.');</script>";
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
         // echo "ERROR: Could not prepare query: " . mysqli_error($conn);
        echo "<script>alert('Error preparing database statement.');</script>";
    }
}

// Fetch Home Content
$home_result = mysqli_query($conn, "SELECT * FROM home_content WHERE id = 1");
$home = mysqli_fetch_assoc($home_result);

// Fetch Services
$services_result = mysqli_query($conn, "SELECT * FROM services");

// Fetch Experience
$exp_result = mysqli_query($conn, "SELECT * FROM experience ORDER BY id DESC");

// Fetch Education
$edu_result = mysqli_query($conn, "SELECT * FROM education ORDER BY id DESC");

// Fetch Skills
$skills_result = mysqli_query($conn, "SELECT * FROM skills");

// Fetch Projects
$projects_result = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");

// Fetch About Me
$about_result = mysqli_query($conn, "SELECT * FROM about_me ORDER BY id ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portfolio</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
</head>

<body id="body">
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress"></div>

    <!-- Custom Cursor -->
    <div class="cursor-dot"></div>
    <div class="cursor-outline"></div>

    <!-- Background Mouse Glow -->
    <div class="mouse-glow"></div>

    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

   <!-- Header -->
<header class="active">
    <a href="#home" class="logo">
        <?php if (!empty($home['logo'])): ?>
            <img src="<?= htmlspecialchars($home['logo']); ?>" alt="Logo">
        <?php endif; ?>
        <?php if (!empty($home['logo_text'])): ?>
            <span><?= htmlspecialchars($home['logo_text']); ?></span>
        <?php elseif (empty($home['logo'])): ?>
            <?= htmlspecialchars($home['name']); ?>
        <?php endif; ?>
    </a>

    <nav class="navbar">
        <a href="#home" class="active">Home-></a>
        <a href="#services">Services</a>
        <a href="#resume">Resume</a>
        <a href="#portfolio">Portfolio</a>
        <a href="#contact">Contact</a>
    </nav>
        <i class="fa-solid fa-bars" id="menu-icon"></i>
    </header>

    <!--bars background-->
    <div class="bars-box active">
        <div class="bar" style="--i:6;"></div>
        <div class="bar" style="--i:5;"></div>
        <div class="bar" style="--i:4;"></div>
        <div class="bar" style="--i:3;"></div>
        <div class="bar" style="--i:2;"></div>
        <div class="bar" style="--i:1;"></div>
    </div>


<!-- Home Section -->
<section class="home active" id="home">
        <div class="home-content">
            <h3><?= htmlspecialchars($home['greeting']); ?></h3>
            <h1><?= htmlspecialchars($home['name']); ?></h1>

            <h3>And I'm a
                <span style="--i:4;" data-text="<?= htmlspecialchars($home['title_1']); ?>"><?= htmlspecialchars($home['title_1']); ?></span>
                <span style="--i:3;" data-text="<?= htmlspecialchars($home['title_2']); ?>"><?= htmlspecialchars($home['title_2']); ?></span>
                <span style="--i:2;" data-text="<?= htmlspecialchars($home['title_3']); ?>"><?= htmlspecialchars($home['title_3']); ?></span>
                <span style="--i:1;" data-text="<?= htmlspecialchars($home['title_4']); ?>"><?= htmlspecialchars($home['title_4']); ?></span>
            </h3>

            <p><?= nl2br(htmlspecialchars($home['description'])); ?></p>

            <div class="btn-sci">
                <?php if (!empty($home['cv_file'])): ?>
                <a href="<?= $home['cv_file']; ?>" download class="btn">Download CV</a>
                <?php else: ?>
                <a href="#" class="btn">No CV Uploaded</a>
                <?php endif; ?>

                <div class="sci">
                    <?php if($home['github_link']) echo '<a href="'.$home['github_link'].'"><i class="bx bxl-github"></i></a>'; ?>
                    <?php if($home['linkedin_link']) echo '<a href="'.$home['linkedin_link'].'"><i class="bx bxl-linkedin"></i></a>'; ?>
                    <?php if($home['whatsapp_link']) echo '<a href="'.$home['whatsapp_link'].'" target="_blank"><i class="bx bxl-whatsapp"></i></a>'; ?>
                    <?php if($home['youtube_link']) echo '<a href="'.$home['youtube_link'].'"><i class="bx bxl-youtube"></i></a>'; ?>
                </div>
            </div>
        </div>

        <div class="home-img">
            <div class="img-box">
                <div class="img-item">
                    <?php 
                    $imgSrc = !empty($home['profile_image']) ? $home['profile_image'] : 'img.png';
                    ?>
                    <img src="<?= $imgSrc; ?>" alt="home image">
                </div>
            </div>
            <!-- Floating Tech Icons -->
            <div class="floating-icons">
                <div class="floating-icon"><i class='bx bxl-react'></i></div>
                <div class="floating-icon"><i class='bx bxl-nodejs'></i></div>
                <div class="floating-icon"><i class='bx bxl-php'></i></div>
            </div>
        </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <h2 class="heading"><span>My</span> <span>Services</span></h2>

    <div class="services-container">
        <?php while ($row = mysqli_fetch_assoc($services_result)): ?>
        <div class="services-box">
            <div class="icon">
                <i class="<?= $row['icon']; ?>"></i>
                <a href="#"><i class="bx bx-arrow-back"></i></a>
            </div>
            <h3><?= htmlspecialchars($row['title']); ?></h3>
            <p><?= nl2br(htmlspecialchars($row['description'])); ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Resume Section -->
<section class="resume" id="resume">
    <div class="resume-container">
        <div class="resume-box">
            <h2>Why Hire Me</h2>
            <p>I am a dedicated and skilled professional with a passion for delivering high-quality work.</p>
            <button class="resume-btn active">Experience</button>
            <button class="resume-btn">Education</button>
            <button class="resume-btn">Skills</button>
            <button class="resume-btn">About Me</button>
        </div>

        <!--- Resume Details Box --->
        <div class="resume-box">
            <!---Experience--->
            <div class="resume-detail experience active">
                <h2 class="heading"><span>My</span> <span>Experience</span></h2>
                <div class="resume-list">
                    <?php 
                    // Reset pointer for experience loop
                    mysqli_data_seek($exp_result, 0);
                    while ($row = mysqli_fetch_assoc($exp_result)): ?>
                    <div class="resume-item">
                        <p class="year"><?= htmlspecialchars($row['year']); ?></p>
                        <h3><?= htmlspecialchars($row['role']); ?></h3>
                        <p class="company"><?= htmlspecialchars($row['company']); ?></p>
                        <p><?= htmlspecialchars($row['description']); ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!---Education--->
            <div class="resume-detail education">
                <h2 class="heading"><span>My</span> <span>Education</span></h2>
                <div class="resume-list">
                    <?php 
                    // Reset pointer for education loop
                    mysqli_data_seek($edu_result, 0);
                    while ($row = mysqli_fetch_assoc($edu_result)): ?>
                    <div class="resume-item">
                        <p class="year"><?= htmlspecialchars($row['year']); ?></p>
                        <h3><?= htmlspecialchars($row['degree']); ?></h3>
                        <p class="company"><?= htmlspecialchars($row['institution']); ?></p>
                        <p><?= htmlspecialchars($row['description']); ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!---Skills--->
            <div class="resume-detail skills">
                <h2 class="heading"><span>My</span> <span>Skills</span></h2>
                <div class="resume-list">
                    <?php 
                    // Reset pointer for skills loop
                    mysqli_data_seek($skills_result, 0);
                    while ($row = mysqli_fetch_assoc($skills_result)): ?>
                    <div class="resume-item">
                        <i class='<?= $row['icon']; ?>'></i>
                        <span><?= htmlspecialchars($row['name']); ?></span>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!---About Me (Dynamic)--->
            <div class="resume-detail about me">
                <h2 class="heading"><span>About</span> <span>Me</span></h2>
                <div class="resume-list">
                    <?php 
                    // Reset pointer for about_me loop
                    mysqli_data_seek($about_result, 0);
                    while ($row = mysqli_fetch_assoc($about_result)): ?>
                        <div class="resume-item">
                            <p><?= htmlspecialchars($row['label']); ?> <span><?= htmlspecialchars($row['value']); ?></span></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="resume-mobile-spacer" style="height: 15rem; width: 100%; display: block; visibility: hidden;"></div>
        </div>
    </div>
</section>

<!--Portfolio Section-->
<section class="portfolio" id="portfolio">
    <h2 class="heading"><span>Latest</span> <span>Project</span></h2>
    <div class="portfolio-container">
        <div class="portfolio-box">
            <?php 
            $i = 1;
            while($row = mysqli_fetch_assoc($projects_result)): 
                $activeClass = ($i == 1) ? 'active' : '';
            ?>
            <div class="portfolio-detail <?= $activeClass; ?>">
                <p class="numb"><?= sprintf("%02d", $i); ?></p>
                <h3><?= htmlspecialchars($row['title']); ?></h3>
                <p><?= nl2br(htmlspecialchars($row['description'])); ?></p>
                <div class="tech">
                    <p><?= htmlspecialchars($row['technologies']); ?></p>
                </div>
                <div class="live-github">
                    <?php if($row['link']) echo '<a href="'.$row['link'].'"><i class="bx bx-arrow-back"></i><span>Live Project</span></a>'; ?>
                    <?php if($row['github_link']) echo '<a href="'.$row['github_link'].'"><i class="bx bxl-github"></i><span>Github Repository</span></a>'; ?>
                </div>
                <!-- Hidden image for JS to pick up -->
                <input type="hidden" class="project-img" value="<?= htmlspecialchars($row['image']); ?>">
            </div>
            <?php $i++; endwhile; ?>
        </div>

        <div class="portfolio-box">
            <div class="portfolio-carousel">
                <div class="img-slide">
                    <?php 
                    // Reset pointer for image loop
                    mysqli_data_seek($projects_result, 0);
                    while($row = mysqli_fetch_assoc($projects_result)): 
                        $img = !empty($row['image']) ? $row['image'] : 'web1.jpg'; // fallback
                    ?>
                    <div class="img-item">
                        <img src="<?= $img; ?>">
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

          <div class="navigation">
                    <button class="arrow arrow-left" disabled>
                        <i class="bx bx-chevron-left"></i>
                    </button>

                    <button class="arrow arrow-right">
                        <i class="bx bx-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Contact-Section-->
<section class="contact" id="contact">
    <div class="contact-container">
        <div class="contact-box">
            <h>Let's Work Together</h>
            <p class="desc">A high-conversion landing page designed to highlight products or services,
             with clear call-to-actions and smooth scrolling interactions.</p>
             <div class="contact-detail">
                <i class="bx bxs-phone"></i>
                <div class="detail">
                    <p>Phone</p>
                    <p>(+252)614750633</p>
                </div>
              </div>
              <div class="contact-detail">
                <i class="bx bxs-envelope"></i>
                <div class="detail">
                    <p>Email</p>
                    <p>Abdisatar107@gmail.com</p>
               </div>
            </div>
            <div class="contact-detail">
                <i class="bx bxs-map"></i>
                <div class="detail">
                    <p>Address</p>
                    <p>123 Anywhere Street Kismayo</p>
                </div>
             </div>
         </div>
<div class="contact-box">
    <h2 class="heading contact-heading"><span>Contact</span> <span>Me!</span></h2>
    <form action="index.php" method="post">
        
<div class="field-box">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="tel" name="phone" placeholder="Phone Number">

    <!-- Gender Select -->
    <select name="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="female">Female</option>
        <option value="male">Male</option>
    </select>

    <input type="text" name="subject" placeholder="Email Subject" required>
    <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
</div>

        <button type="submit" class="btn">Send Message</button>
    </form>
</div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 by <?= htmlspecialchars($home['name']); ?> | All Rights Reserved.</p>
        </div>

        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>
</section>

    <!-- JavaScript -->
    <script src="script.js"></script>
</body>
</html>