        .marquee-container {
            width: 100%;
            height: 60px; /* Increased height for larger content */
            overflow: hidden;
            white-space: nowrap;
            background-color:navy;
            padding: 20px 0; /* Increased padding */
            position: relative;
        }

        .marquee-content {
            display: inline-flex;
            align-items: center;
            position: absolute;
            will-change: transform;
            animation: marquee 10s linear infinite;
        }

        .marquee-content img {
            height: 50px; /* Larger image size */
            margin-right: 30px; /* Increased spacing */
            vertical-align: middle;
        }

        .marquee-content span {
            font-size: 36px; /* Larger font size */
            color: #333;
            margin-right: 30px; /* Increased spacing */
        }

        @keyframes marquee {
            0% {
                transform: translateX(100vw);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Pause animation on hover */
        .marquee-container:hover .marquee-content {
            animation-play-state: paused;
        }