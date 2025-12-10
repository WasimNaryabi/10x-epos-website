<template>
    <section class="hero-section">
        <!-- Background Pattern -->
        <div class="hero-pattern"></div>
        
        <div class="hero-container">
            <!-- Left Content -->
            <div class="hero-content" data-aos="fade-right">
                <h1 class="hero-title">
                    Transform Your 
                    <span class="highlight">Restaurant Business</span> 
                    with 10x Global EPOS
                </h1>
                
                <p class="hero-description">
                    The complete point of sale solution designed for cafes and restaurants. 
                    Streamline operations, boost sales, and delight customers with our all-in-one 
                    cloud-based EPOS system.
                </p>

                <!-- Feature Tags -->
                <div class="feature-tags">
                    <span class="tag">
                        <Icon name="check" :size="16" color="#10b981" />
                        Cloud-Based
                    </span>
                    <span class="tag">
                        <Icon name="check" :size="16" color="#10b981" />
                        Real-Time Reporting
                    </span>
                    <span class="tag">
                        <Icon name="check" :size="16" color="#10b981" />
                        24/7 Support
                    </span>
                </div>

                <!-- CTA Buttons -->
                <div class="hero-buttons">
                    <button @click="$emit('request-demo')" class="btn-primary">
                        <Icon name="calendar" :size="20" color="white" />
                        Request Free Demo
                    </button>
                    <button @click="$emit('contact-sales')" class="btn-secondary">
                        <Icon name="phone" :size="20" color="currentColor" />
                        Talk to Sales
                    </button>
                </div>

                <!-- Trust Indicators -->
                <div class="trust-indicators">
                    <div class="trust-item">
                        <div class="trust-number">500+</div>
                        <div class="trust-label">Active Restaurants</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-number">99.9%</div>
                        <div class="trust-label">Uptime</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-number">24/7</div>
                        <div class="trust-label">Support</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Real Dashboard Screenshots -->
            <div class="hero-image" data-aos="fade-left">
                <div class="dashboard-preview">
                    <!-- Main Dashboard Image -->
                    <div class="dashboard-main">
                        <img 
                            src="/images/dashboard.jpg" 
                            alt="10x Global EPOS Dashboard"
                            class="dashboard-img"
                        />
                        <div class="dashboard-badge">
                            <span class="pulse"></span>
                            <span>Live Dashboard</span>
                        </div>
                    </div>

                    <!-- Floating Light Mode Dashboard -->
                    <div class="dashboard-floating" data-aos="fade-up" data-aos-delay="200">
                        <img 
                            src="/images/dashboard_light.jpg" 
                            alt="10x Global EPOS Dashboard Light Mode"
                            class="dashboard-img-small"
                        />
                        <div class="theme-badge">
                            <Icon name="sun" :size="16" color="#fbbf24" />
                            <span>Light Mode</span>
                        </div>
                    </div>

                    <!-- Floating Notification -->
                    <div class="floating-notification" data-aos="fade-left" data-aos-delay="400">
                        <div class="notification-icon">
                            <Icon name="receipt" :size="20" color="white" />
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">New Order #1234</div>
                            <div class="notification-text">Table 5 - £45.50</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="600">
            <div class="scroll-text">Scroll to explore</div>
            <div class="scroll-arrow">
                <Icon name="chevron-down" :size="24" color="white" />
            </div>
        </div>
    </section>
</template>

<script setup>
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo', 'contact-sales']);
</script>

<style scoped>
.hero-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
    padding-top: 80px;
}

.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
    background-size: cover;
    background-position: bottom;
    opacity: 0.6;
}

.hero-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    position: relative;
    z-index: 1;
}

.hero-content {
    color: white;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1.5rem;
}

.highlight {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-description {
    font-size: 1.25rem;
    line-height: 1.8;
    margin-bottom: 2rem;
    color: rgba(255, 255, 255, 0.95);
}

.feature-tags {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2.5rem;
}

.tag {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
}

.hero-buttons {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-bottom: 3rem;
}

.btn-primary, .btn-secondary {
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    border: none;
}

.btn-primary {
    background: white;
    color: #667eea;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.trust-indicators {
    display: flex;
    gap: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.trust-item {
    text-align: center;
}

.trust-number {
    font-size: 2rem;
    font-weight: 800;
    color: #ffd700;
    margin-bottom: 0.25rem;
}

.trust-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Dashboard Preview */
.hero-image {
    position: relative;
}

.dashboard-preview {
    position: relative;
    transform: perspective(1200px) rotateY(-8deg);
    transition: transform 0.5s ease;
}

.dashboard-preview:hover {
    transform: perspective(1200px) rotateY(0deg);
}

/* Main Dashboard */
.dashboard-main {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 25px 60px rgba(0, 0, 0, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    border: 3px solid rgba(255, 255, 255, 0.2);
    background: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.dashboard-main:hover {
    transform: translateY(-10px);
    box-shadow: 
        0 35px 80px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.15);
}

.dashboard-img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.dashboard-main:hover .dashboard-img {
    transform: scale(1.02);
}

.dashboard-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(16, 185, 129, 0.95);
    backdrop-filter: blur(10px);
    padding: 0.6rem 1.2rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.pulse {
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.3); }
}

/* Floating Light Mode Dashboard */
.dashboard-floating {
    position: absolute;
    bottom: -40px;
    right: -50px;
    width: 45%;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 
        0 20px 50px rgba(0, 0, 0, 0.35),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    border: 3px solid rgba(255, 255, 255, 0.2);
    background: white;
    z-index: 2;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.dashboard-floating:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 
        0 30px 70px rgba(0, 0, 0, 0.45),
        0 0 0 1px rgba(255, 255, 255, 0.15);
}

.dashboard-img-small {
    width: 100%;
    height: auto;
    display: block;
}

.theme-badge {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: #0f172a;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    border: 2px solid rgba(251, 191, 36, 0.3);
}

/* Floating Notification */
.floating-notification {
    position: absolute;
    top: 30px;
    left: -50px;
    background: white;
    border-radius: 15px;
    padding: 1rem 1.5rem;
    box-shadow: 
        0 15px 40px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(236, 72, 153, 0.2);
    display: flex;
    gap: 1rem;
    align-items: center;
    z-index: 3;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.floating-notification:hover {
    transform: translateX(-5px) scale(1.05);
    box-shadow: 
        0 20px 50px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.15);
}

.notification-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    background: linear-gradient(135deg, #ec4899, #f43f5e);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
}

.notification-title {
    font-weight: 600;
    color: #0f172a;
    font-size: 0.95rem;
}

.notification-text {
    font-size: 0.85rem;
    color: #64748b;
    margin-top: 2px;
}

/* Old styles removal */
.dashboard-mockup,
.dashboard-card,
.main-card,
.card-header,
.live-badge,
.stats-grid,
.stat-item,
.stat-icon,
.bg-blue,
.bg-green,
.stat-details,
.stat-label,
.stat-value,
.stat-change,
.floating-card,
.mini-chart,
.chart-header,
.chart-value,
.chart-svg {
    /* Removed - no longer needed */
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: white;
    z-index: 2;
}

.scroll-text {
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
    opacity: 0.8;
}

.scroll-arrow {
    font-size: 1.5rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(10px); }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-container {
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .dashboard-preview {
        transform: none;
    }

    .dashboard-floating {
        bottom: -30px;
        right: -30px;
        width: 40%;
    }

    .floating-notification {
        left: -30px;
        top: 20px;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding-top: 60px;
    }

    .hero-title {
        font-size: 2rem;
    }

    .hero-description {
        font-size: 1rem;
    }

    .trust-indicators {
        gap: 1.5rem;
    }

    .trust-number {
        font-size: 1.5rem;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .btn-primary, .btn-secondary {
        width: 100%;
        justify-content: center;
    }

    .dashboard-floating,
    .floating-notification {
        display: none;
    }

    .dashboard-main {
        border-width: 2px;
    }
}
</style>