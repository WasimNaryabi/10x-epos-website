<template>
    <section id="screenshots" class="screenshots-section">
        <div class="screenshots-container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Sell smarter, Manage faster</h2>
                <p class="section-subtitle">
                    Explore our intuitive interface designed for speed and efficiency
                </p>
            </div>

            <!-- Main Featured Image -->
            <div class="featured-screenshot" data-aos="zoom-in">
                <div class="screenshot-wrapper">
                    <img 
                        :src="featuredImage.src" 
                        :alt="featuredImage.alt"
                        class="featured-img"
                    />
                    <div class="screenshot-badge">
                        <Icon name="star" :size="16" color="#fbbf24" />
                        <span>{{ featuredImage.label }}</span>
                    </div>
                </div>
            </div>

            <!-- Screenshot Gallery Grid -->
            <div class="screenshots-grid">
                <div 
                    v-for="(screenshot, index) in screenshots" 
                    :key="index"
                    class="screenshot-card"
                    :data-aos="index % 2 === 0 ? 'fade-right' : 'fade-left'"
                    :data-aos-delay="index * 100"
                    @click="openLightbox(screenshot)"
                >
                    <div class="screenshot-image">
                        <img 
                            :src="screenshot.src" 
                            :alt="screenshot.alt"
                            loading="lazy"
                        />
                        <div class="screenshot-overlay">
                            <Icon name="search" :size="32" color="white" />
                            <span class="view-text">Click to View</span>
                        </div>
                    </div>
                    <div class="screenshot-info">
                        <h3 class="screenshot-title">{{ screenshot.title }}</h3>
                        <p class="screenshot-description">{{ screenshot.description }}</p>
                        <div class="screenshot-features">
                            <span 
                                v-for="(feature, idx) in screenshot.features" 
                                :key="idx"
                                class="feature-tag"
                            >
                                {{ feature }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Theme Switcher Preview -->
            <div class="theme-preview" data-aos="fade-up">
                <h3>Light & Dark Modes</h3>
                <p>Work comfortably in any environment with our dual theme options</p>
                <div class="theme-images">
                    <div class="theme-card">
                        <img src="/images/dashboard_light.jpg" alt="Light Mode" />
                        <div class="theme-label">
                            <Icon name="sun" :size="20" color="#fbbf24" />
                            <span>Light Mode</span>
                        </div>
                    </div>
                    <div class="theme-card">
                        <img src="/images/dashboard.jpg" alt="Dark Mode" />
                        <div class="theme-label">
                            <Icon name="moon" :size="20" color="#8b5cf6" />
                            <span>Dark Mode</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="screenshots-cta" data-aos="fade-up">
                <h3>Ready to Transform Your Business?</h3>
                <p>See how 10x Global EPOS can streamline your operations</p>
                <button @click="$emit('request-demo')" class="cta-button">
                    <Icon name="calendar" :size="20" color="white" />
                    Schedule a Demo
                </button>
            </div>
        </div>

        <!-- Lightbox Modal -->
        <transition name="fade">
            <div v-if="showLightbox" class="lightbox-overlay" @click="closeLightbox">
                <div class="lightbox-content" @click.stop>
                    <button class="lightbox-close" @click="closeLightbox">
                        <Icon name="close" :size="24" color="white" />
                    </button>
                    <img :src="currentLightboxImage.src" :alt="currentLightboxImage.alt" />
                    <div class="lightbox-info">
                        <h3>{{ currentLightboxImage.title }}</h3>
                        <p>{{ currentLightboxImage.description }}</p>
                    </div>
                    <div class="lightbox-navigation">
                        <button @click="previousImage" class="nav-btn">
                            <Icon name="arrow-left" :size="24" color="white" />
                        </button>
                        <button @click="nextImage" class="nav-btn">
                            <Icon name="arrow-right" :size="24" color="white" />
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo']);

const showLightbox = ref(false);
const currentLightboxIndex = ref(0);

const featuredImage = ref({
    src: '/images/dashboard.jpg',
    alt: 'Main Dashboard',
    label: 'Featured'
});

const screenshots = ref([
    {
        src: '/images/pos_menu.jpg',
        alt: 'POS Interface',
        title: 'Point of Sale',
        description: 'Fast and intuitive ordering interface for quick service',
        features: ['Quick Order', 'Split Bills', 'Table Management']
    },
    {
        src: '/images/orders.jpg',
        alt: 'Order Management',
        title: 'Order Management',
        description: 'Track and manage all orders in real-time',
        features: ['Live Updates', 'Order History', 'Status Tracking']
    },
    {
        src: '/images/kot.jpg',
        alt: 'Kitchen Display',
        title: 'Kitchen Display (KOT)',
        description: 'Streamline kitchen operations with digital order tickets',
        features: ['Color Coded', 'Prep Times', 'Auto Alerts']
    },
    {
        src: '/images/inventory.jpg',
        alt: 'Inventory Management',
        title: 'Inventory Control',
        description: 'Never run out of stock with smart inventory tracking',
        features: ['Stock Alerts', 'Auto Reorder', 'Waste Tracking']
    },
    {
        src: '/images/menu.jpg',
        alt: 'Menu Management',
        title: 'Menu Management',
        description: 'Easy-to-use menu editor with photos and modifiers',
        features: ['Drag & Drop', 'Categories', 'Modifiers']
    },
    {
        src: '/images/reports.jpg',
        alt: 'Analytics & Reports',
        title: 'Advanced Analytics',
        description: 'Detailed insights to help you make better decisions',
        features: ['Sales Reports', 'Staff Performance', 'Trends']
    }
]);

const currentLightboxImage = ref({});

const openLightbox = (screenshot) => {
    currentLightboxIndex.value = screenshots.value.indexOf(screenshot);
    currentLightboxImage.value = screenshot;
    showLightbox.value = true;
    document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
    showLightbox.value = false;
    document.body.style.overflow = '';
};

const previousImage = () => {
    currentLightboxIndex.value = 
        (currentLightboxIndex.value - 1 + screenshots.value.length) % screenshots.value.length;
    currentLightboxImage.value = screenshots.value[currentLightboxIndex.value];
};

const nextImage = () => {
    currentLightboxIndex.value = 
        (currentLightboxIndex.value + 1) % screenshots.value.length;
    currentLightboxImage.value = screenshots.value[currentLightboxIndex.value];
};
</script>

<script setup></script>

<style scoped>
.screenshots-section {
    padding: 6rem 2rem;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}

.screenshots-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}

/* Featured Screenshot */
.featured-screenshot {
    margin-bottom: 4rem;
}

.screenshot-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s;
}

.screenshot-wrapper:hover {
    transform: translateY(-10px);
}

.featured-img {
    width: 100%;
    height: auto;
    display: block;
}

.screenshot-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #0f172a;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Screenshots Grid */
.screenshots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2.5rem;
    margin-bottom: 4rem;
}

.screenshot-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}

.screenshot-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.screenshot-image {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16 / 10;
}

.screenshot-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.screenshot-card:hover .screenshot-image img {
    transform: scale(1.05);
}

.screenshot-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 11, 94, 0.9);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s;
}

.screenshot-card:hover .screenshot-overlay {
    opacity: 1;
}

.view-text {
    color: white;
    font-weight: 600;
}

.screenshot-info {
    padding: 1.5rem;
}

.screenshot-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.screenshot-description {
    color: #64748b;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.screenshot-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.feature-tag {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    color: #0369a1;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.8125rem;
    font-weight: 500;
}

/* Theme Preview */
.theme-preview {
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    text-align: center;
    margin-bottom: 4rem;
}

.theme-preview h3 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.theme-preview p {
    color: #64748b;
    margin-bottom: 2rem;
}

.theme-images {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.theme-card {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.theme-card:hover {
    transform: translateY(-5px);
}

.theme-card img {
    width: 100%;
    height: auto;
    display: block;
}

.theme-label {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #0f172a;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* CTA */
.screenshots-cta {
    text-align: center;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    padding: 3rem 2rem;
    border-radius: 20px;
    color: white;
}

.screenshots-cta h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.screenshots-cta p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
}

.cta-button {
    padding: 1rem 2.5rem;
    background: white;
    color: #1a0b5e;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: transform 0.3s, box-shadow 0.3s;
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
}

/* Lightbox */
.lightbox-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.lightbox-content {
    position: relative;
    max-width: 1200px;
    width: 100%;
}

.lightbox-content img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
}

.lightbox-close {
    position: absolute;
    top: -50px;
    right: 0;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s;
}

.lightbox-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.lightbox-info {
    text-align: center;
    color: white;
    margin-top: 1.5rem;
}

.lightbox-info h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.lightbox-info p {
    color: rgba(255, 255, 255, 0.8);
}

.lightbox-navigation {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 1rem;
    pointer-events: none;
}

.nav-btn {
    pointer-events: all;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s;
}

.nav-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Transitions */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .screenshots-section {
        padding: 4rem 1.5rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .screenshots-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .theme-images {
        grid-template-columns: 1fr;
    }

    .lightbox-navigation {
        padding: 0;
    }

    .nav-btn {
        width: 40px;
        height: 40px;
    }
}
</style>