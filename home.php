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
:root {
    --primary: #1a1a1a;
    --accent: #22c55e; /* Green Theme */
    --text: #1a1a1a;
    --muted: #6b7280;
    --bg: #f3f4f6; /* Very light gray */
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--text);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}

/* NAVIGATION */
.floating-nav {
    position: absolute;
    top: 2rem;
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
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 2rem;
    border: 1px solid rgba(255,255,255,0.3);
}

.nav-links .logo {
    font-weight: 700;
    font-size: 1.1rem;
    margin-right: 1rem;
    letter-spacing: -0.02em;
}

.nav-links a {
    text-decoration: none;
    color: var(--primary);
    font-size: 0.9rem;
    font-weight: 500;
}

.nav-btn {
    background: var(--primary);
    color: white;
    padding: 0.8rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-size: 0.9rem;
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
    bottom: 2.5rem;
    background: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    padding: 0.6rem 1.5rem;
    border-radius: 50px;
    color: var(--primary);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.pill-down span {
    background: var(--primary);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
}

/* MISSION SECTION */
.mission {
    background: white;
    padding: 8rem 5%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6rem;
}

.mission-left {
    position: relative;
}

.section-num {
    color: var(--accent);
    font-size: 0.9rem;
    font-weight: 500;
    position: absolute;
    top: 0;
    left: 0;
}

.mission-images {
    margin-top: 4rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
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
    margin-top: 4rem;
}

.quote-text {
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 1.5rem;
    line-height: 1.4;
}

.quote-author {
    font-size: 0.8rem;
    color: var(--muted);
    margin-top: 0.5rem;
}

.mission-right h2 {
    font-size: 3rem;
    font-weight: 500;
    line-height: 1.15;
    letter-spacing: -0.02em;
    padding-top: 4rem;
}

/* SUSTAINABILITY BANNER */
.sustainability {
    background: var(--bg);
    padding: 6rem 0;
    text-align: center;
    overflow: hidden;
}

.sustainability h2 {
    font-size: clamp(2.5rem, 8vw, 6rem);
    font-weight: 600;
    letter-spacing: -0.04em;
    color: #e5e7eb;
    position: relative;
    display: inline-block;
}

.sustainability h2 span {
    color: var(--accent);
    position: relative;
    z-index: 2;
}



/* DARK IMPACT SECTION */
.impact-wrapper {
    background: var(--bg);
    padding: 0 5% 5rem;
}

.dark-card {
    background: #111;
    color: white;
    border-radius: 24px;
    padding: 5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    position: relative;
}

.dark-card-header h3 {
    font-size: 2.5rem;
    font-weight: 500;
    line-height: 1.2;
    margin-top: 1rem;
}

.dark-card-header .num {
    color: var(--muted);
    font-size: 0.9rem;
}

.pill-outline {
    display: inline-block;
    border: 1px solid rgba(255,255,255,0.3);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    margin-top: auto;
    position: absolute;
    bottom: 5rem;
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
    margin-bottom: 3rem;
}

.stat-large h4 {
    font-size: 3.5rem;
    font-weight: 500;
    color: var(--accent);
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-large p {
    font-size: 0.9rem;
    color: #999;
}

.stat-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.stat-small h4 {
    font-size: 2.5rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: white;
}

.stat-small p {
    font-size: 0.8rem;
    color: #999;
}

/* BOTTOM GRID SECTION */
.bottom-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: auto auto;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.bottom-text {
    grid-column: span 2;
    padding: 2rem 0;
}

.bottom-text .num {
    color: var(--muted);
    font-size: 0.8rem;
    margin-bottom: 1rem;
    display: block;
}

.bottom-text p {
    font-size: 1.8rem;
    font-weight: 500;
    line-height: 1.3;
    letter-spacing: -0.02em;
}

.testimonial {
    grid-column: span 2;
    background: white;
    border-radius: 16px;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.testimonial p {
    font-size: 1.1rem;
    font-weight: 500;
    line-height: 1.5;
}

.testimonial .author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
}

.author-img {
    width: 40px;
    height: 40px;
    background: #ddd;
    border-radius: 50%;
}

.author-info strong {
    font-size: 0.9rem;
    display: block;
}
.author-info span {
    font-size: 0.8rem;
    color: var(--muted);
}

.box-dark {
    background: #111;
    color: white;
    border-radius: 16px;
    padding: 2.5rem;
    position: relative;
}

.box-dark h4 {
    font-size: 2.5rem;
    font-weight: 500;
    color: var(--accent);
    margin-bottom: 0.5rem;
}

.box-dark p {
    font-size: 0.85rem;
    color: #999;
}

.box-arrow {
    position: absolute;
    bottom: 1.5rem;
    right: 1.5rem;
    width: 30px;
    height: 30px;
    background: var(--accent);
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
    padding: 2.5rem;
}

.box-light h4 {
    font-size: 2.5rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.box-light p {
    font-size: 0.85rem;
    color: var(--muted);
}

/* FOOTER */
.site-footer {
    background: #111;
    color: white;
    padding: 5rem 5% 2rem;
    margin-top: 2rem;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding-bottom: 3rem;
    margin-bottom: 2rem;
}

.footer-brand h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
    color: white;
}

.footer-brand p {
    color: #999;
    font-size: 0.95rem;
    max-width: 300px;
    line-height: 1.5;
}

.footer-links {
    display: flex;
    gap: 4rem;
}

.link-group {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.link-group h4 {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.link-group a {
    color: #ccc;
    text-decoration: none;
    font-size: 0.95rem;
    transition: color 0.2s;
}

.link-group a:hover {
    color: var(--accent);
}

.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #666;
    font-size: 0.85rem;
}

@media(max-width: 1024px) {
    .mission, .dark-card { grid-template-columns: 1fr; gap: 3rem; }
    .bottom-grid { grid-template-columns: 1fr 1fr; }
    .hero-title { font-size: 16vw; }
    .mission-images { margin-top: 2rem; }
    .mission-right h2 { padding-top: 1rem; }
    .pill-outline { position: static; margin-top: 2rem; display: inline-block; }
}

@media(max-width: 768px) {
    .floating-nav { top: 1rem; }
    .nav-links a:not(.logo) { display: none; }
    .nav-links { gap: 0; padding: 0.6rem 1.2rem; }
    .nav-btn { padding: 0.6rem 1.2rem; font-size: 0.85rem; }
    
    .hero { min-height: 500px; }
    .hero-title { font-size: 18vw; }
    
    .mission { padding: 4rem 5%; gap: 2rem; }
    .mission-images { grid-template-columns: 1fr; gap: 1.5rem; }
    .img-2 { margin-top: 0; }
    .mission-right h2 { font-size: 1.8rem; }
    
    .impact-wrapper { padding: 0 5% 2rem; }
    .dark-card { padding: 2.5rem; border-radius: 16px; gap: 2rem; }
    .dark-card-header h3 { font-size: 1.8rem; }
    .stat-row { grid-template-columns: 1fr; gap: 1.5rem; }
    .stat-large h4 { font-size: 2.8rem; }
    .stat-small h4 { font-size: 2rem; }
    
    .bottom-grid { grid-template-columns: 1fr; gap: 1rem; }
    .bottom-text, .testimonial { grid-column: span 1; }
    .bottom-text { padding: 1rem 0; }
    .bottom-text p { font-size: 1.5rem; }
    .testimonial { padding: 2rem; }
    .box-dark, .box-light { padding: 2rem; }
    .box-dark h4, .box-light h4 { font-size: 2rem; }
    
    /* Footer Mobile */
    .footer-content { flex-direction: column; gap: 3rem; }
    .footer-links { flex-direction: column; gap: 2rem; width: 100%; }
    .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
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