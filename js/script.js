const counters = document.querySelectorAll(".counter");
const observerOptions = {
  threshold: 0.5,
};
const observer = new IntersectionObserver(function (entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting && !entry.target.classList.contains("counted")) {
      const updateCounter = () => {
        const target = +entry.target.getAttribute("data-target");
        const count = +entry.target.innerText;
        const increment = Math.ceil(target / 100);
        if (count < target) {
          entry.target.innerText = count + increment;
          setTimeout(updateCounter, 30);
        } else {
          entry.target.innerText = target + "+";
        }
      };
      updateCounter();
      entry.target.classList.add("counted");
    }
  });
}, observerOptions);
counters.forEach((counter) => {
  observer.observe(counter);
});
const revealElements = document.querySelectorAll(".reveal");
const revealObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
      }
    });
  },
  { threshold: 0.1 },
);
revealElements.forEach((el) => revealObserver.observe(el));
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});