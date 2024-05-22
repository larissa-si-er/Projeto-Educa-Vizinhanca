document.querySelectorAll('progress').forEach(progress => {
    progress.addEventListener('mousemove', e => {
      const value = progress.value;
      progress.setAttribute('title', `${value}%`);
    });
  });
  