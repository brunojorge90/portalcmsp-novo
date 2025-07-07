export default class Drag {
    classd;
    width;
    gap;
    isDragging = false;
    isDraggingMove = false;
    startX;
    translateX = 0;
    minTranslate = 0;
    maxTranslate;
    content;
    container;
    fitcontent;
    link;

    constructor(classd = '.contentDrag', width = 256, gap = 32, fitcontent = false) {
        this.classd = classd;
        this.width = width;
        this.gap = gap;
        this.fitcontent = fitcontent;
        this.ready();
    }

    calculateMaxTranslate() {
        const containerWidth = this.container.offsetWidth;
        const contentWidth = this.content.offsetWidth;
        this.maxTranslate = containerWidth - contentWidth;
        this.maxTranslate = Math.min(0, this.maxTranslate); // Ensures the maximum value is negative (for left translation)
    }

    clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    ready() {
        this.container = document.querySelector('.container');
        this.content = document.querySelector(this.classd);

        if (!this.fitcontent) {
            const cols = document.querySelectorAll(`${this.classd} .colEvent`);
            this.content.style.width = `${cols.length * this.width + (cols.length - 1) * this.gap}px`;
        } else {
            let v = 0;
            const cols = document.querySelectorAll(`${this.classd} .colEvent`);
            cols.forEach((z) => {
                v += z.offsetWidth + this.gap;
            });
            this.content.style.width = `${v - this.gap}px`;
        }

        const handleMouseDown = (e) => {
            this.startX = e.pageX;

            const handleMouseMove = (e) => {
                const x = e.pageX;
                const diffX = x - this.startX;

                if (!this.isDragging && Math.abs(diffX) > 2) {
                    this.isDragging = true;
                    this.content.style.cursor = 'grabbing';
                    this.content.classList.add('grabbing');
                }

                if (this.isDragging) {
                    this.translateX += diffX;
                    this.translateX = this.clamp(this.translateX, this.maxTranslate, this.minTranslate);
                    this.content.style.transform = `translateX(${this.translateX}px)`;
                    this.startX = x;
                }
            };

            const handleMouseUp = () => {
                    this.isDragging = false;
                    this.content.style.cursor = 'default';
                    this.content.classList.remove('grabbing');
                    window.removeEventListener('mousemove', handleMouseMove);
                    window.removeEventListener('mouseup', handleMouseUp);
            };

            const handleMouseLeave = () => {
                if (this.isDragging) {
                    this.isDragging = false;
                    this.content.style.cursor = 'default';
                    this.content.classList.remove('grabbing');
                    window.removeEventListener('mousemove', handleMouseMove);
                    window.removeEventListener('mouseup', handleMouseUp);
                    window.removeEventListener('mouseleave', handleMouseLeave);
                }
            };

            window.addEventListener('mousemove', handleMouseMove);
            window.addEventListener('mouseup', handleMouseUp);
            window.addEventListener('mouseleave', handleMouseLeave);
        };


        const handleTouchStart = (e) => {
            this.isDragging = true;
            this.startX = e.touches[0].clientX;
        };

        const handleTouchEnd = () => {
            this.isDragging = false;
        };

        const handleTouchMove = (e) => {
            if (!this.isDragging) return;
            const x = e.touches[0].clientX;
            const diffX = x - this.startX;
            this.translateX += diffX;
            this.translateX = this.clamp(this.translateX, this.maxTranslate, this.minTranslate);
            this.content.style.transform = `translateX(${this.translateX}px)`;
            this.startX = x;
        };


        const handleResize = () => {
            this.calculateMaxTranslate();
        };

        const handleBlur = () => {
            this.isDragging = false;
            this.content.style.cursor = 'default';
            this.content.classList.remove('grabbing');
        };
        this.content.addEventListener('mousedown', handleMouseDown);
        this.content.addEventListener('touchstart', handleTouchStart);
        this.content.addEventListener('touchend', handleTouchEnd);
        this.content.addEventListener('touchmove', handleTouchMove);
        this.content.addEventListener('resize', handleResize);
        this.content.addEventListener('blur', handleBlur);

        this.calculateMaxTranslate();
    }
}
