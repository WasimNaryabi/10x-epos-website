<template>
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">
                    Built by <span class="highlight">Operators</span>, 
                    For <span class="highlight">Operators</span>
                </h1>
                <p class="hero-subtitle">
                    Real experience. Real solutions. Real results.
                </p>
            </div>
        </div>

        <!-- Decorative Background -->
        <div class="hero-background">
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>
        </div>
    </section>
</template>

<script setup>
// No props or state needed
</script>

<style scoped>
.hero-section {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #1a0b5e 0%, #5842c3 100%);
    overflow: hidden;
}

.hero-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
}

.hero-content {
    text-align: center;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    color: white;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.highlight {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: clamp(1.2rem, 2vw, 1.5rem);
    color: rgba(255, 255, 255, 0.95);
    font-weight: 500;
}

/* Decorative Background */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 1;
    pointer-events: none;
}

.gradient-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
    animation: float 20s ease-in-out infinite;
}

.orb-1 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, #667eea, transparent);
    top: -100px;
    right: -100px;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, #764ba2, transparent);
    bottom: -100px;
    left: -100px;
    animation-delay: -10s;
}

@keyframes float {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -30px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

@media (max-width: 768px) {
    .hero-section {
        min-height: 60vh;
    }

    .orb-1, .orb-2 {
        width: 300px;
        height: 300px;
    }
}
</style>