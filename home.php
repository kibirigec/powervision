<?php
/**
 * PowerVision - Modern Landing Page (Voltz Inspired Design)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PowerVision — Energy Tracking Made Simple</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: #f3f4f6;
    color: #1a1a1a;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}

/* NAVIGATION */
.floating-nav {
    position: absolute;
    top: 32px;
    left: 5%;
    right: 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 100;
}

.nav-links {
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(12px);
    padding: 8px 24px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 32px;
    border: 1px solid rgba(255,255,255,0.3);
}

.nav-links .logo {
    font-weight: 700;
    font-size: 18px;
    margin-right: 16px;
    letter-spacing: -0.02em;
}

.nav-links a {
    text-decoration: none;
    color: #1a1a1a;
    font-size: 14px;
    font-weight: 500;
}

.nav-btn {
    background: #1a1a1a;
    color: white;
    padding: 13px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: transform 0.2s ease;
}

.nav-btn:hover {
    transform: translateY(-2px);
}

/* HERO SECTION */
.hero {
    height: 100vh;
    min-height: 700px;
    background: #a3b18a url('images/hero.jpeg') center/cover no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
}

.hero-title {
    font-size: 14vw;
    color: white;
    font-weight: 600;
    letter-spacing: -0.04em;
    line-height: 0.9;
    text-align: center;
    width: 100%;
}

.char-anim {
    display: inline-block;
    opacity: 0;
    transform: translateY(40px);
    animation: fadeUpChar 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
}

@keyframes fadeUpChar {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* SCROLL REVEAL ANIMATION */
.reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

.delay-1 { transition-delay: 0.1s; }
.delay-2 { transition-delay: 0.2s; }
.delay-3 { transition-delay: 0.3s; }

.pill-down {
    position: absolute;
    bottom: 40px;
    background: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    padding: 10px 24px;
    border-radius: 50px;
    color: #1a1a1a;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}
.pill-down span {
    background: #1a1a1a;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
}

/* MISSION SECTION */
.mission {
    background: white;
    padding: 128px 5%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 96px;
}

.mission-left {
    position: relative;
}

.section-num {
    color: #22c55e;
    font-size: 14px;
    font-weight: 500;
    position: absolute;
    top: 0;
    left: 0;
}

.mission-images {
    margin-top: 64px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    align-items: start;
}

.mission-images img {
    width: 100%;
    border-radius: 16px;
    object-fit: cover;
}

.img-1 {
    aspect-ratio: 4/3;
}

.img-2 {
    aspect-ratio: 4/3;
    margin-top: 64px;
}

.quote-text {
    font-size: 14px;
    font-weight: 600;
    margin-top: 24px;
    line-height: 1.4;
}

.quote-author {
    font-size: 13px;
    color: #6b7280;
    margin-top: 8px;
}

.mission-right h2 {
    font-size: 48px;
    font-weight: 500;
    line-height: 1.15;
    letter-spacing: -0.02em;
    padding-top: 64px;
}

/* SUSTAINABILITY BANNER */
.sustainability {
    background: #f3f4f6;
    padding: 96px 0;
    text-align: center;
    overflow: hidden;
}

.sustainability h2 {
    font-size: clamp(40px, 8vw, 96px);
    font-weight: 600;
    letter-spacing: -0.04em;
    color: #e5e7eb;
    position: relative;
    display: inline-block;
}

.sustainability h2 span {
    color: #22c55e;
    position: relative;
    z-index: 2;
}



/* DARK IMPACT SECTION */
.impact-wrapper {
    background: #f3f4f6;
    padding: 0 5% 80px;
}

.dark-card {
    background: #111;
    color: white;
    border-radius: 24px;
    padding: 80px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    position: relative;
}

.dark-card-header h3 {
    font-size: 40px;
    font-weight: 500;
    line-height: 1.2;
    margin-top: 16px;
}

.dark-card-header .num {
    color: #6b7280;
    font-size: 14px;
}

.pill-outline {
    display: inline-block;
    border: 1px solid rgba(255,255,255,0.3);
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 13px;
    margin-top: auto;
    position: absolute;
    bottom: 80px;
    transition: background 0.3s ease;
}

.pill-outline:hover {
    background: rgba(255,255,255,0.1);
}

.dark-stats {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.stat-large {
    margin-bottom: 48px;
}

.stat-large h4 {
    font-size: 56px;
    font-weight: 500;
    color: #22c55e;
    line-height: 1;
    margin-bottom: 8px;
}

.stat-large p {
    font-size: 14px;
    color: #999;
}

.stat-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}

.stat-small h4 {
    font-size: 40px;
    font-weight: 500;
    margin-bottom: 8px;
    color: white;
}

.stat-small p {
    font-size: 13px;
    color: #999;
}

/* BOTTOM GRID SECTION */
.bottom-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: auto auto;
    gap: 24px;
    margin-top: 24px;
}

.bottom-text {
    grid-column: span 2;
    padding: 32px 0;
}

.bottom-text .num {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 16px;
    display: block;
}

.bottom-text p {
    font-size: 29px;
    font-weight: 500;
    line-height: 1.3;
    letter-spacing: -0.02em;
}

.testimonial {
    grid-column: span 2;
    background: white;
    border-radius: 16px;
    padding: 48px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.testimonial p {
    font-size: 18px;
    font-weight: 500;
    line-height: 1.5;
}

.testimonial .author {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 32px;
}

.author-img {
    width: 40px;
    height: 40px;
    background: #ddd;
    border-radius: 50%;
}

.author-info strong {
    font-size: 14px;
    display: block;
}
.author-info span {
    font-size: 13px;
    color: #6b7280;
}

.box-dark {
    background: #111;
    color: white;
    border-radius: 16px;
    padding: 40px;
    position: relative;
}

.box-dark h4 {
    font-size: 40px;
    font-weight: 500;
    color: #22c55e;
    margin-bottom: 8px;
}

.box-dark p {
    font-size: 14px;
    color: #999;
}

.box-arrow {
    position: absolute;
    bottom: 24px;
    right: 24px;
    width: 30px;
    height: 30px;
    background: #22c55e;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111;
    font-weight: bold;
}

.box-light {
    background: white;
    border-radius: 16px;
    padding: 40px;
}

.box-light h4 {
    font-size: 40px;
    font-weight: 500;
    margin-bottom: 8px;
}

.box-light p {
    font-size: 14px;
    color: #6b7280;
}

/* FOOTER */
.site-footer {
    background: #111;
    color: white;
    padding: 80px 5% 32px;
    margin-top: 32px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding-bottom: 48px;
    margin-bottom: 32px;
}

.footer-brand h2 {
    font-size: 32px;
    font-weight: 600;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
    color: white;
}

.footer-brand p {
    color: #999;
    font-size: 15px;
    max-width: 300px;
    line-height: 1.5;
}

.footer-links {
    display: flex;
    gap: 64px;
}

.link-group {
    display: flex;
    flex-direction: column;
    gap: 13px;
}

.link-group h4 {
    font-size: 14px;
    color: #666;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.link-group a {
    color: #ccc;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.2s;
}

.link-group a:hover {
    color: #22c55e;
}

.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #666;
    font-size: 14px;
}

@media(max-width: 1024px) {
    .mission, .dark-card { grid-template-columns: 1fr; gap: 48px; }
    .bottom-grid { grid-template-columns: 1fr 1fr; }
    .hero-title { font-size: 16vw; }
    .mission-images { margin-top: 32px; }
    .mission-right h2 { padding-top: 16px; }
    .pill-outline { position: static; margin-top: 32px; display: inline-block; }
}

@media(max-width: 768px) {
    .floating-nav { top: 16px; }
    .nav-links a:not(.logo) { display: none; }
    .nav-links { gap: 0; padding: 10px 19px; }
    .nav-btn { padding: 10px 19px; font-size: 14px; }
    
    .hero { min-height: 500px; }
    .hero-title { font-size: 18vw; }
    
    .mission { padding: 64px 5%; gap: 32px; }
    .mission-images { grid-template-columns: 1fr; gap: 24px; }
    .img-2 { margin-top: 0; }
    .mission-right h2 { font-size: 29px; }
    
    .impact-wrapper { padding: 0 5% 32px; }
    .dark-card { padding: 40px; border-radius: 16px; gap: 32px; }
    .dark-card-header h3 { font-size: 29px; }
    .stat-row { grid-template-columns: 1fr; gap: 24px; }
    .stat-large h4 { font-size: 45px; }
    .stat-small h4 { font-size: 32px; }
    
    .bottom-grid { grid-template-columns: 1fr; gap: 16px; }
    .bottom-text, .testimonial { grid-column: span 1; }
    .bottom-text { padding: 16px 0; }
    .bottom-text p { font-size: 24px; }
    .testimonial { padding: 32px; }
    .box-dark, .box-light { padding: 32px; }
    .box-dark h4, .box-light h4 { font-size: 32px; }
    
    /* Footer Mobile */
    .footer-content { flex-direction: column; gap: 48px; }
    .footer-links { flex-direction: column; gap: 32px; width: 100%; }
    .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
}
</style>
</head>
<body>

<nav class="floating-nav">
    <div class="nav-links">
        <span class="logo">PowerVision</span>
        <a href="#mission">Mission</a>
        <a href="#impact">Features</a>
        <a href="#how-it-works">How it Works</a>
    </div>
    <a href="index.php" class="nav-btn">Login to App</a>
</nav>

<header class="hero">
    <h1 class="hero-title" id="animated-title">Track Energy</h1>
    <a href="#mission" class="pill-down">How it Works <span>↓</span></a>
</header>

<section id="mission" class="mission">
    <div class="mission-left reveal">
        <span class="section-num">01 /</span>
        <div class="mission-images">
            <div>
                <img src="images/smarthome.avif" alt="Home Energy" class="img-1">
                <p class="quote-text">"We believe understanding your energy usage is the first step toward a sustainable world."</p>
                <p class="quote-author">PowerVision Team</p>
            </div>
            <div>
                <img src="images/hero.jpeg" alt="Smart Home" class="img-2">
            </div>
        </div>
    </div>
    <div class="mission-right reveal delay-1">
        <h2>PowerVision exists to make your electricity usage transparent, measurable, and easy to manage. Because true sustainability starts right in your own home.</h2>
    </div>
</section>

<div class="sustainability reveal">
    <h2 style = 'color: #86868b'>Sustainabil<span>ity</span></h2>
</div>

<section class="impact-wrapper" id="impact">
    <div class="dark-card reveal">
        <div class="dark-card-header">
            <span class="num">03 /</span>
            <h3>Take Control.<br>Here's Why Tracking<br>Your Energy Matters.</h3>
            
            <a href="register.php" style="color:white; text-decoration:none;" class="pill-outline">Start Tracking Today →</a>
        </div>
        <div class="dark-stats">
            <div class="stat-large">
                <h4>SDG 7</h4>
                <p>Ensuring affordable, reliable, and modern energy for all.</p>
            </div>
            <div class="stat-row">
                <div class="stat-small">
                    <h4>kWh</h4>
                    <p>Automated calculation of energy used based on hours logged.</p>
                </div>
                <div class="stat-small">
                    <h4>UGX</h4>
                    <p>Real-time cost estimation using your local energy tariffs.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-grid" id="how-it-works">
        <div class="bottom-text reveal">
            <span class="num">04 /</span>
            <p>Every logged hour helps you understand your habits, reduce waste, and save money.</p>
        </div>
        
        <div class="testimonial reveal delay-1">
            <p>"PowerVision made it incredibly simple to find out which appliances were spiking my electricity bill. Now I know exactly where my money goes."</p>
            <div class="author">
                <div class="author-img"></div>
                <div class="author-info">
                    <strong>Calvin</strong>
                    <span>Homeowner & Early User</span>
                </div>
            </div>
        </div>

        <div class="box-dark reveal">
            <h4>Log<br>Usage</h4>
            <p style="margin-top:1rem;">Easily record daily hours for your fridge, TV, or iron.</p>
            <div class="box-arrow">→</div>
        </div>

        <div class="box-light reveal delay-1">
            <h4>Track<br>Costs</h4>
            <p style="margin-top:1rem;">Convert watts and hours directly into estimated bills.</p>
        </div>

        <div class="box-light reveal delay-2">
            <h4>Reduce<br>Waste</h4>
            <p style="margin-top:1rem;">Identify "energy vampires" and optimize your habits.</p>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h2>PowerVision</h2>
            <p>Empowering households to achieve SDG 7 through transparent and accessible energy tracking.</p>
        </div>
        <div class="footer-links">
            <div class="link-group">
                <h4>Product</h4>
                <a href="#impact">Features</a>
                <a href="#how-it-works">How it Works</a>
                <a href="index.php">Login</a>
                <a href="register.php">Get Started</a>
            </div>
            <div class="link-group">
                <h4>Company</h4>
                <a href="#mission">Our Mission</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> PowerVision. All rights reserved.</p>
        <p>Built for Sustainable Development Goal 7</p>
    </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Animate hero title letters
    const title = document.getElementById('animated-title');
    if (title) {
        const text = title.innerText;
        title.innerHTML = '';
        [...text].forEach((char, i) => {
            const span = document.createElement('span');
            span.innerText = char === ' ' ? '\u00A0' : char; // preserve space
            span.className = 'char-anim';
            span.style.animationDelay = `${i * 0.05}s`;
            title.appendChild(span);
        });
    }
    
    // Scroll Reveal Animations
    const reveals = document.querySelectorAll('.reveal');
    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, revealOptions);

    reveals.forEach(reveal => {
        revealOnScroll.observe(reveal);
    });
});
</script>

</body>
</html>