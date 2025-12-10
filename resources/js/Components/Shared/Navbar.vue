<template>
    <!-- Under Construction Banner -->
    <div class="construction-banner">
        <div class="construction-content">
            <Icon name="settings" :size="18" color="white" class="construction-icon" />
            <span class="construction-text">
                <strong>Website Under Construction</strong> – We will be operational soon!
            </span>
        </div>
    </div>

    <nav id="navbar" class="navbar" :class="{ scrolled: isScrolled }">
        <div class="nav-container">
            <!-- Logo -->
            <a href="/" class="logo">
                <img src="/images/10x-global-logo.png" alt="10x Global EPOS" class="logo-img" />
                <span class="logo-text"></span>
            </a>

            <!-- Desktop Navigation -->
            <ul class="nav-links" id="navLinks" :class="{ 'mobile-active': mobileMenuOpen }">
                <li><a href="#features" @click="closeMobileMenu">Features</a></li>
                <li><a href="#pricing" @click="closeMobileMenu">Pricing</a></li>
                <li><a href="#testimonials" @click="closeMobileMenu">Testimonials</a></li>
                <li><a href="#partners" @click="closeMobileMenu">Partners</a></li>
                <li><a href="#contact" @click="closeMobileMenu">Contact</a></li>
                <li class="nav-button-item">
                    <button @click="handleDemoClick" class="btn-demo">
                        Request Demo
                    </button>
                </li>
            </ul>

            <!-- Mobile Menu Toggle -->
            <button 
                class="mobile-toggle" 
                id="mobileToggle"
                @click="toggleMobileMenu"
                :class="{ active: mobileMenuOpen }"
            >
                <Icon v-if="!mobileMenuOpen" name="menu" :size="24" color="currentColor" />
                <Icon v-else name="close" :size="24" color="currentColor" />
            </button>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

const emit = defineEmits(['request-demo']);

const isScrolled = ref(false);
const mobileMenuOpen = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
    
    // Prevent body scroll when menu is open
    if (mobileMenuOpen.value) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
};

const closeMobileMenu = () => {
    mobileMenuOpen.value = false;
    document.body.style.overflow = '';
};

const handleDemoClick = () => {
    closeMobileMenu();
    emit('request-demo');
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    document.body.style.overflow = '';
});
</script>

<style scoped>
/* Under Construction Banner */
.construction-banner {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    z-index: 1001;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.construction-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0.75rem 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.construction-icon {
    animation: rotate 2s linear infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.construction-text {
    font-size: 0.875rem;
    text-align: center;
}

.construction-text strong {
    font-weight: 700;
}

/* Navbar */
.navbar {
    position: fixed;
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    z-index: 1000;
    transition: all 0.3s ease;
    top: 48px; /* Height of construction banner */
    left: 0;
}

.navbar.scrolled {
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
}

.nav-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.2rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.logo-img {
    height: 60px;
    width: auto;
    object-fit: contain;
}

.logo-text {
    font-size: 1.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.nav-links {
    display: flex;
    list-style: none;
    gap: 2.5rem;
    align-items: center;
    margin: 0;
    padding: 0;
}

.nav-links a {
    text-decoration: none;
    color: #0f172a;
    font-weight: 500;
    font-size: 0.95rem;
    transition: color 0.3s;
    position: relative;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    transition: width 0.3s;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-links a:hover {
    color: #667eea;
}

.btn-demo {
    padding: 0.75rem 1.75rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.95rem;
    transition: transform 0.3s, box-shadow 0.3s;
}

.btn-demo:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.mobile-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.5rem;
    color: #0f172a;
}

@media (max-width: 1024px) {
    .nav-links {
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .construction-content {
        padding: 0.6rem 1.5rem;
        gap: 0.5rem;
    }

    .construction-text {
        font-size: 0.75rem;
    }

    .construction-icon {
        flex-shrink: 0;
    }

    .mobile-toggle {
        display: flex;
        z-index: 1001;
    }

    .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        width: 80%;
        max-width: 400px;
        height: 100vh;
        background: white;
        flex-direction: column;
        justify-content: center;
        gap: 2rem;
        padding: 2rem;
        box-shadow: -5px 0 30px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
    }

    .nav-links.mobile-active {
        right: 0;
    }

    .nav-links a {
        font-size: 1.125rem;
    }

    .nav-button-item {
        width: 100%;
    }

    .btn-demo {
        width: 100%;
        padding: 1rem;
        font-size: 1rem;
    }

    .nav-links a::after {
        display: none;
    }
}

@media (max-width: 480px) {
    .logo {
        font-size: 1.25rem;
    }

    .logo i {
        font-size: 1.5rem;
    }

    .nav-container {
        padding: 1rem 1.5rem;
    }
}
</style>