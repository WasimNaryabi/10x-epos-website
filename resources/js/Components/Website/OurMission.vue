<template>
    <section class="mission-section">
        <div class="container">
            <div class="mission-content" data-aos="fade-up">
                <h2 class="mission-title">Our Mission</h2>
                <p class="mission-text">
                    10x Global is not just software to us. It is the result of years spent on the ground, 
                    dealing with the same pressures every operator faces. It is built to simplify day-to-day work, 
                    give teams better visibility, and free up time so businesses can focus on growth and improvement 
                    instead of constantly fixing problems.
                </p>

                <div class="mission-highlight" data-aos="zoom-in" data-aos-delay="200">
                    <h3 class="highlight-title">Our Goal Is Straightforward</h3>
                    <p class="highlight-text">
                        Create tools that help operators operate. Nothing overcomplicated, nothing out of touch – 
                        just technology that supports real businesses in the real world.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// No props or state needed
</script>

<style scoped>
.mission-section {
    padding: 7rem 2rem;
    background: white;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
}

.mission-content {
    text-align: center;
}

.mission-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 2rem;
}

.mission-text {
    font-size: clamp(1.1rem, 1.8vw, 1.4rem);
    line-height: 2;
    color: #64748b;
    margin-bottom: 3rem;
}

.mission-highlight {
    background: #f8fafc;
    padding: 3rem;
    border-radius: 25px;
    border: 2px solid #1a0b5e;
}

.highlight-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700;
    color: #1a0b5e;
    margin-bottom: 1.5rem;
}

.highlight-text {
    font-size: clamp(1rem, 1.5vw, 1.2rem);
    line-height: 1.9;
    color: #0f172a;
}

@media (max-width: 768px) {
    .mission-section {
        padding: 4rem 1.5rem;
    }

    .mission-highlight {
        padding: 2rem;
    }
}
</style>