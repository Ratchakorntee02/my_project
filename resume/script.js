// ฝั่งชั่นสำหรับเปลี่ยนหน้าเมื่อเลือกเมนู
document.addEventListener('DOMContentLoaded', () =>{
    const navLinks = document.querySelectorAll('.nav a');
    const feeds = document.querySelectorAll('.feed');

        navLinks.forEach(link => {
            link.addEventListener('click' , (e) => {
                e.preventDefault();

                const target = e.target.getAttribute('href').substring(1);

                feeds.forEach(feed => feed.classList.remove('active'));
                
                const targetFeed = document.getElementById(target);
                if(targetFeed){
                    targetFeed.classList.add('active');
                }
                });
            });
        });        
