SET GLOBAL default_storage_engine = 'InnoDB';

DROP TABLE IF EXISTS `order_detail`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `product`;
DROP TABLE IF EXISTS `discuss`;
DROP TABLE IF EXISTS `artwork_comment`;
DROP TABLE IF EXISTS `artwork`;
DROP TABLE IF EXISTS `forum`;
DROP TABLE IF EXISTS `user`;


CREATE TABLE user (
    user_id INT(4) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(45) NOT NULL,
    password VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL UNIQUE,
    slogan VARCHAR(225),
    role ENUM('visitor', 'artist', 'admin') NOT NULL
);

CREATE TABLE artwork (
    artwork_id INT(4) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(4) ZEROFILL NOT NULL,
    title VARCHAR(100) NOT NULL,
    type ENUM('Traditional Painting', 'Digital Design', 'Sketch') NOT NULL,
    cover VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    intro TEXT,
    likes_count INT DEFAULT 0,
    post_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);

CREATE TABLE artwork_comment (
    comment_id INT(5) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(4) ZEROFILL NOT NULL,
    artwork_id INT(4) ZEROFILL NOT NULL,
    content VARCHAR(225) NOT NULL,
    post_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
    FOREIGN KEY (artwork_id) REFERENCES artwork(artwork_id) ON DELETE CASCADE
);

CREATE TABLE forum (
    forum_id INT(4) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(4) ZEROFILL NOT NULL,

    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);


DELIMITER //

-- Trigger: every time a new user with the role of artist is created, a new row is automatically added to the forum table.

CREATE TRIGGER after_insert_user
AFTER INSERT ON user
FOR EACH ROW
BEGIN
    IF NEW.role = 'artist' THEN
        INSERT INTO forum (user_id) VALUES (NEW.user_id);
    END IF;
END //

DELIMITER ;


CREATE TABLE discuss (
    discuss_id INT(5) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    forum_id INT(4) ZEROFILL NOT NULL,
    user_id INT(4) ZEROFILL NOT NULL,
    content VARCHAR(225) NOT NULL,
    post_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (forum_id) REFERENCES forum(forum_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);



-- 插入语句

-- 用户：admin
INSERT INTO user (user_id, name, password, email, role)
VALUES
(0, 'Admin', 'Admin001', 'admin001@artgallery.com', 'admin');

-- 用户：artist和visitor
INSERT INTO user (name, password, email, slogan, role)
VALUES
('Chen Wei', 'GrPOX7WyFz6F6', 'chenwei@gmail.com', 'Spreading happiness through art', 'artist'),
('Ling Yun', 'GrPOX7WyFz6F6', 'ling.yun@artverse.com', 'The wind whispers ancient tales under the desert sun, carrying timeless beauty in each breeze.', 'artist'),
('Yao Mei', 'GrPOX7WyFz6F6', 'yaomei.art@gmail.com', 'Mystical serenity unfolds in vivid strokes, where imagination meets history on the canvas.', 'artist'),
('Bai Yu', 'GrPOX7WyFz6F6', 'baiyu@example.com', 'Unveiling the essence of timeless beauty', 'artist'),
('Shuhong Chang', 'GrPOX7WyFz6F6', 'shuhongchang.art@duneart.com', 'Blossoms of creativity bloom amidst the dunes, where heritage and innovation unite in color', 'artist'),
('Xue Ling', 'GrPOX7WyFz6F6', 'xue.ling@flowingart.com', 'My paints flow like the endless river, capturing life''s fleeting yet eternal beauty', 'artist'),
('Zi Xin', 'GrPOX7WyFz6F6', 'zixin@example.com', 'Harmony in chaos, peace in turmoil', 'artist'),
('Qiu Rui', 'GrPOX7WyFz6F6', 'qiu.rui@ancientart.com', 'Echoes of ancient murals breathe through my brush, blending history with new perspectives.', 'artist'),
('Yi Fan', 'GrPOX7WyFz6F6', 'yifan.dunhuangart@colors.com', 'Colors of Dunhuang, shadows of history—bringing forgotten legends back to life through art.', 'artist'),
('Li Hua', 'GrPOX7WyFz6F6', 'li.hua@heritageartist.com', 'Guardian of Dunhuang''s artistic heritage, preserving cultural treasures for the future', 'artist'),
('Zhang Wei', 'GrPOX7WyFz6F6', 'zhangwei.artist@gmail.com', 'Capturing the essence of life through my brush, one stroke at a time.', 'artist'),
('Li Ming', 'GrPOX7WyFz6F6', 'liming.creative@gmail.com', 'Each canvas tells a story, revealing the beauty of the world within.', 'artist'),
('Wang Fang', 'GrPOX7WyFz6F6', 'wangfang.artistic@gmail.com', 'Nature inspires my art, reflecting the harmony between humanity and earth.', 'artist'),
('Liu Xue', 'GrPOX7WyFz6F6', 'liuxue.artlover@gmail.com', 'Expressing emotions through colors, creating a symphony on canvas.', 'artist'),
('Zhao Rui', 'GrPOX7Wy Fz6F6', 'zhaorui.painter@gmail.com', 'Exploring the depths of tradition and innovation in every piece.', 'artist'),
('Chen Yu', 'GrPOX7Wy Fz6F6', 'chenyu.vibrant@gmail.com', 'Bringing dreams to life through vibrant colors and dynamic forms.', 'artist'),
('Sun Ying', 'GrPOX7Wy Fz6F6', 'sunying.creativity@gmail.com', 'Merging the past with the present, each artwork a bridge through time.', 'artist'),
('Qian Ling', 'GrPOX7Wy Fz6F6', 'qianling.soulart@gmail.com', 'My art is a reflection of the soul, capturing the unseen essence of life.', 'artist'),
('Xu Lei', 'GrPOX7Wy Fz6F6', 'xulei.artisticjourney@gmail.com', 'Discovering beauty in the mundane, elevating the ordinary to extraordinary.', 'artist'),
('He Ying', 'GrPOX7WyFz6F6', 'heying.impression@gmail.com', 'Transcending the ordinary, each stroke unveils a new dimension of beauty.', 'artist'),
('Guo Jian', 'GrPOX7WyFz6F6', 'guojian.creation@gmail.com', 'Each piece is a dialogue with nature, expressing my connection to the world.', 'artist'),
('Feng Yu', 'GrPOX7WyFz6F6', 'fengyu.inspired@gmail.com', 'Inspired by history, my work reflects the layers of culture and time.', 'artist'),
('Wei Jun', 'GrPOX7WyFz6F6', 'weijun.artistry@gmail.com', 'My brush dances with passion, creating a rhythm of life on canvas.', 'artist'),
('Tang Mei', 'GrPOX7WyFz6F6', 'tangmei.artistic@gmail.com', 'Every artwork is a journey, inviting viewers to explore new worlds.', 'artist'),

('Alice', 'GrCymZ2cKng7E', 'alice@example.com', 'Traveling the world one step at a time', 'visitor'),
('Bob', 'GrCymZ2cKng7E', 'bob123@example.com', 'Creativity takes courage', 'visitor'),
('Charlie', 'GrCymZ2cKng7E', 'charlie01@example.com', 'Leading the way', 'visitor'),
('Emma Li', 'GrCymZ2cKng7E', 'emma.li@culturalenthusiast.com', 'A culture enthusiast from afar, finding joy in the beauty of shared human heritage.', 'visitor'),
('Liu Bei', 'GrCymZ2cKng7E', 'liu.bei@wisdompath.com', 'Walking the path of wisdom and art, discovering the stories they whisper to the soul', 'visitor'),
('Grace Cheng', 'GrCymZ2cKng7E', 'grace.cheng@techhistory.com', 'Where history meets technology, blending the old and the new to reveal unseen connections', 'visitor'),
('Wang Xin', 'GrCymZ2cKng7E', 'wang.xin@artpreservation.com', 'Passionate about art and preservation, safeguarding our cultural legacy for generations to come.', 'visitor'),
('Karen Wu', 'GrCymZ2cKng7E', 'karen.wu@silkroadart.com', 'Discovering the beauty of the Silk Road through art, where cultures meet and inspire.', 'visitor');


-- 作品信息
INSERT INTO artwork (user_id, title, type, cover, intro, likes_count)
VALUES
(1, 'Whispers of Apsara', 'Traditional Painting', 'images/art_picture/apsara_whispers.jpg', 'This delicate ink painting captures the ethereal movement of the Apsaras, celestial beings from Buddhist mythology, as they glide gracefully through the air. Inspired by the flowing forms and intricate patterns of Dunhuang murals, the painting transports viewers to a world of divine elegance. The soft strokes and subtle color palette evoke the timeless beauty and spiritual tranquility that define the artistic heritage of Dunhuang. This work embodies the peaceful serenity and free-spirited nature of the Apsaras as they dance through eternity.', 2),
(1, 'Reproduction of Dunhuang Murals', 'Traditional Painting', 'images/art_picture/dunhuang_reproduction.jpg', 'This vibrant reproduction of the renowned Dunhuang murals captures the cultural and spiritual essence of ancient China. Painstakingly detailed, it recreates the vivid colors, intricate designs, and narrative richness that define the original frescoes. The artwork celebrates the religious and historical significance of Dunhuang''s artistic legacy, preserving the intricate Buddhist iconography and the majestic depictions of divine figures and mythical beings. It serves as a tribute to one of the most enduring artistic achievements of Chinese civilization, keeping the spirit of the murals alive.', 17),
(2, 'The Lotus Throne Divinity', 'Traditional Painting', 'images/art_picture/lotus_throne_divinity.jpg', 'A breathtaking depiction of a divine figure seated upon a lotus flower, this painting symbolizes purity, enlightenment, and the transcendence of the material world. Drawing inspiration from Dunhuang''s spiritual motifs, the artist captures the celestial presence of the deity through vibrant colors and fine details. The soft glow emanating from the figure represents inner peace and wisdom, while the lotus throne is a reminder of spiritual awakening. The intricate patterns surrounding the deity add a layer of divine mystery, reflecting the spiritual depth of ancient Chinese Buddhist art.', 10),
(3, 'Celestial Music of the Pipa', 'Traditional Painting', 'images/art_picture/celestial_pipa_flight.jpg', 'In this exquisite work, a Flying Apsara is captured mid-flight, playing a pipa in harmonious rhythm. The painting brings to life the celestial music that echoes through the realms of Buddhist paradise. The Apsara''s graceful form and flowing ribbons are painted with delicate brushstrokes, giving the impression of movement and rhythm. The scene embodies both the artistic beauty and the musical heritage of Dunhuang, where music and dance played key roles in religious rituals and storytelling. The serene expression of the Apsara reflects the peace and joy found in spiritual enlightenment.', 9),
(4, 'The Serene Buddha in Ink', 'Traditional Painting', 'images/art_picture/serene_buddha.jpg', 'This masterful ink painting presents a serene and tranquil Buddha, embodying deep spiritual wisdom and compassion. The minimalist use of ink strokes emphasizes the calm and meditative nature of the figure, while capturing the essence of Buddhist teachings. The subtle shading and fine lines evoke the peacefulness that comes with enlightenment, drawing influence from the contemplative and solemn representations of Buddha found in the Dunhuang murals. The serene gaze of the Buddha invites viewers to reflect on inner peace and mindfulness, a theme central to ancient Buddhist art.', 0),
(4, 'The Banquet of Prosperity', 'Traditional Painting', 'images/art_picture/banquet_prosperity.jpg', 'This vibrant ink painting captures the grand celebration of a banquet scene, brimming with lively characters and sumptuous food. The artwork evokes the cultural prosperity and social richness of ancient China, showcasing not only the material abundance but also the harmony and unity of the people. The detailed portrayal of traditional clothing, utensils, and architecture reflects the artistic and cultural sophistication of the era. The joy and energy radiating from the banquet symbolize the harmony between nature, humanity, and the divine.', 12),
(5, 'Caves Under the Snow', 'Traditional Painting', 'images/art_picture/caves_under_snow.jpg', 'This peaceful watercolor painting reveals the tranquil beauty of the Dunhuang caves nestled beneath a blanket of snow. The muted colors and soft brushstrokes bring out the quiet, contemplative atmosphere of winter in the desert. The snow-covered landscape contrasts with the rugged stone of the caves, symbolizing the resilience and timelessness of Dunhuang''s cultural heritage. The serene depiction evokes a sense of solitude and introspection, mirroring the spiritual significance of the Mogao Caves as places of meditation and artistic reflection.', 7),
(5, 'The Mogao Caves at Night', 'Traditional Painting', 'images/art_picture/mogao_night.jpg', 'Bathed in the soft glow of moonlight, this painting brings to life the Mogao Caves under the night sky, evoking the mysterious aura that surrounds these ancient monuments. The moonlight highlights the intricate carvings and murals that have stood for centuries, shrouded in both history and legend. The mystical atmosphere of the night emphasizes the sacred and enduring nature of the caves, while also hinting at the secrets and stories hidden within their walls. The painting offers a glimpse into a world where art, spirituality, and history converge beneath the stars.', 0),
(5, 'Music and Dance from a Millennium Ago', 'Traditional Painting', 'images/art_picture/music_dance_millennium.jpg', 'This dynamic painting celebrates the vibrant cultural life of ancient Dunhuang, capturing musicians and dancers in traditional attire performing in joyous harmony. Set against the backdrop of a thousand years ago, the artwork breathes life into the age-old music and dance that resonated through temples and royal courts alike. The intricate detailing of the musical instruments and fluidity of the dancers’ movements reflect the artistic precision and cultural vibrancy that defined the region. It offers a nostalgic glimpse into the festive spirit of the time, where art and tradition were interwoven into daily life.', 0),
(5, 'The Medicine Buddha Sutra', 'Traditional Painting', 'images/art_picture/medicine_buddha.jpg', 'This intricately detailed painting depicts the Medicine Buddha surrounded by sacred symbols of healing, wisdom, and compassion. Inspired by Buddhist teachings, the artwork reflects the profound spiritual significance of the Medicine Buddha Sutra, which emphasizes health, well-being, and the alleviation of suffering. The tranquil expression of the Buddha and the vibrant depictions of medicinal plants and symbols evoke a sense of peace and serenity. This painting serves as a spiritual guide, connecting viewers to the ancient wisdom that resonates through the teachings of Dunhuang''s religious art.', 3),
(6, 'The Azure Lotus Dream', 'Traditional Painting', 'images/art_picture/ebony_twin_apsaras.jpg', 'This mesmerizing painting depicts two ethereal Apsaras, celestial dancers from Buddhist lore, performing a synchronized, mirrored dance mid-flight. Their flowing garments and delicate movements create an almost hypnotic sense of rhythm and grace. The pairing of the two figures emphasizes balance and harmony, which are core elements of Dunhuang''s spiritual artistry. The use of soft, azure tones combined with intricate details highlights the divine elegance and transcendent beauty that these celestial beings symbolize.', 10),
(6, 'Emerald Spirit of Divinity', 'Traditional Painting', 'images/art_picture/emerald_spirit.jpg', 'This deep and meditative painting portrays a divine figure cloaked in various shades of green, representing spiritual wisdom and inner peace. The figure radiates an otherworldly energy, embodying the mystical aura prevalent in the mythology and art of Dunhuang. The carefully composed imagery, with subtle hints of emerald and jade, invokes a connection between nature and divinity, symbolizing the eternal wisdom embedded in the natural world. This piece resonates with the tranquil and reflective themes found throughout ancient Buddhist teachings.', 0),
(6, 'The Graceful Divine Deer', 'Traditional Painting', 'images/art_picture/graceful_deer.jpg', 'A captivating oil painting, this artwork showcases a majestic deer standing gracefully amidst a bed of lotus blossoms. The deer, often seen as a symbol of beauty, purity, and gentleness, is portrayed with an air of tranquility and calm, qualities revered in the narratives of Dunhuang. The lotus flowers add a layer of spiritual symbolism, as they are traditionally associated with enlightenment and rebirth. The piece invites viewers into a serene, almost dreamlike world where nature and divinity exist in harmonious balance.', 8),
(7, 'The Flower-Wielding Goddess', 'Traditional Painting', 'images/art_picture/flower_goddess.jpg', 'This serene painting depicts a goddess holding a delicate bouquet of flowers, her flowing robes and graceful posture embodying femininity and divine beauty. The flowers in her hands symbolize purity and elegance, reflecting the soft, gentle beauty often celebrated in Dunhuang''s art. The goddess''s calm expression and poised demeanor evoke feelings of peace and tranquility, while the soft hues and detailed brushwork highlight the ethereal nature of this celestial being. Her figure captures the timeless grace that is a hallmark of ancient Buddhist art.', 0),
(8, 'Mythical Realm in Dunhuang', 'Traditional Painting', 'images/art_picture/mythical_dunhuang_scene.jpg', 'This fantastical painting transports viewers into a mythical realm inspired by the legendary stories of Dunhuang. It is filled with divine beings and mythical creatures, each playing a role in the rich tapestry of ancient Chinese lore. The vibrant colors and dynamic compositions bring to life the spiritual world that has been preserved for centuries in the murals of the Mogao Caves. This piece captures the imagination, echoing the awe and wonder that these ancient myths continue to inspire in the hearts of those who encounter Dunhuang''s cultural legacy.', 4),
(9, 'Encounter with Flying Nymph', 'Traditional Painting', 'images/art_picture/encounter_dunhuang_dancer.jpg', 'This painting portrays a Flying Nymph, one of the celestial figures from Buddhist mythology, mid-dance as she glides gracefully through the sky. The vivid depiction highlights her flowing robes and delicate movements, capturing the elegance and dynamism that characterize Dunhuang''s artistic tradition. Her pose is a tribute to the dance forms and spiritual symbolism embedded in the murals of the Mogao Caves, representing divine beauty and the celestial realm.', 0),
(10, 'The Nine-Story Tower', 'Traditional Painting', 'images/art_picture/nine_story_tower.jpg', 'The artwork showcases the iconic nine-story tower, a significant architectural marvel of Dunhuang, standing tall against the stark landscape. The intricate detailing of the tower''s structure and its surroundings evokes the grandeur of ancient times, symbolizing the cultural and spiritual aspirations of those who built it. This painting draws attention to the fusion of architecture and nature that defines Dunhuang''s historic sites, making it a tribute to the preservation of heritage.', 2),
(11, 'The Offering Maiden at Baicheng', 'Traditional Painting', 'images/art_picture/offering_maiden.jpg', 'This intricate painting brings to life the image of a female donor at the Baicheng caves, paying homage to the historical practice of patronage in Buddhist art. The figure, clothed in richly detailed robes, represents the individuals who contributed to the creation of Dunhuang''s masterpieces. Her solemn posture and serene expression reflect her deep spiritual dedication, and the artwork highlights the cultural and religious significance of such donors in the region''s artistic history.', 0),
(11, 'The Tiger Sacrifice', 'Traditional Painting', 'images/art_picture/tiger_sacrifice.jpg', 'A dramatic scene unfolds in this oil painting, which captures the tense moment of a sacrificial ritual involving a tiger. The use of bold colors and dynamic brushwork adds to the intensity of the moment, reflecting themes of sacrifice, courage, and spiritual devotion that were prevalent in the narratives of Dunhuang''s art. The composition draws attention to the tiger as a powerful symbol of strength and bravery, with the ritual emphasizing the value placed on selflessness and spiritual duty.', 0),
(11, 'The Teachings of the Buddha', 'Traditional Painting', 'images/art_picture/buddha_teachings.jpg', 'In this evocative painting, the Buddha is shown seated, delivering profound teachings to a group of attentive disciples. The artist beautifully captures the tranquility and wisdom of the Buddha, surrounded by intricate symbolic elements, including lotus flowers and serene landscapes. The scene is a tribute to the spiritual heritage of Dunhuang, where such depictions of the Buddha are central to the narratives of enlightenment, compassion, and moral guidance, offering viewers a glimpse into the teachings that have shaped the region''s spiritual landscape.', 7),
(12, 'The Nine-Colored Deer''s Journey', 'Digital Design', 'images/art_picture/nine_colored_deer.jpg', 'This stunning digital artwork brings to life the legendary Nine-Colored Deer from Dunhuang mythology. Utilizing advanced digital techniques, the piece captures the enchanting story of the deer''s journey through lush landscapes filled with vibrant flora. The use of rich colors and intricate details evokes a sense of wonder, inviting viewers to explore the harmonious relationship between nature and mythical beings as depicted in ancient tales.', 18),
(13, 'New Wave of Dunhuang and Guochao', 'Digital Design', 'images/art_picture/dunhuang_guochao.jpg', 'In this innovative piece, a fusion of traditional Dunhuang elements and modern "Guochao" aesthetics is beautifully realized through digital design. The artist skillfully blends cultural heritage with contemporary visuals, creating a striking representation that bridges the past with the present. This artwork invites viewers to reflect on the relevance of historical motifs in today''s design landscape, showcasing the dynamic evolution of cultural expressions.', 0),
(14, 'Circular Harmony of Dunhuang Deco', 'Digital Design', 'images/art_picture/dunhuang_deco_harmony.jpg', 'A mixed-media digital creation, this piece draws inspiration from the intricate decorative patterns of Dunhuang, conveying a sense of harmony and unity. The artist employs various design techniques to celebrate the rich history of Dunhuang''s artistry, utilizing modern tools to reinterpret traditional aesthetics. This design encapsulates the essence of craftsmanship that has inspired generations, inviting viewers to appreciate the beauty of cultural continuity.', 0),
(15, 'Beatitudes of Heaven', 'Digital Design', 'images/art_picture/beatitudes_of_heaven.jpg', 'Capturing the serene and divine atmosphere of heavenly blessings, this digital painting depicts a radiant, celestial realm reminiscent of the tranquil essence found in Dunhuang. Using sophisticated graphic design techniques, the artist creates a luminous landscape that evokes feelings of peace and serenity. The imagery embodies the spiritual qualities associated with Dunhuang art, illustrating the profound connection between the heavens and earthly existence.', 20),
(15, 'Kingdom of Blessings', 'Digital Design', 'images/art_picture/ocean_melody_fairy.jpg', 'This beautiful digital design showcases the Eight Beatitudes, representing themes of peace and divine favor, inspired by the motifs prevalent in Dunhuang art. Through the use of advanced design software, the artist weaves together elements of traditional iconography with contemporary aesthetics, resulting in a piece that resonates with both historical significance and modern interpretation. The work serves as a reminder of the enduring nature of spiritual abundance across cultures.', 0),
(15, 'Carpet Design with Dunhuang Elements', 'Digital Design', 'images/art_picture/carpet_dunhuang_elements.jpg', 'Featuring an intricate carpet pattern inspired by Dunhuang motifs, this digital design incorporates vibrant colors and cultural elements that reflect ancient craftsmanship. Utilizing digital techniques, the artist meticulously crafts each detail to echo the richness of traditional textiles. This piece pays homage to the artistry of carpet making while celebrating the legacy of Dunhuang''s design principles in a modern context.', 3),
(16, 'Lotus Petal Design', 'Digital Design', 'images/art_picture/lotus_petal_design.jpg', 'A delicate digital artwork focusing on the design of lotus petals, this piece symbolizes purity and spiritual enlightenment. Drawing from the decorative patterns found in Dunhuang murals, the artist employs graphic design tools to create a soft and ethereal aesthetic. The lotus serves as a powerful symbol in many cultures, and this artwork beautifully highlights its significance within the context of Dunhuang''s rich artistic heritage.', 0),
(17, 'Nine-Colored Deer Stepping on Lotus', 'Digital Design', 'images/art_picture/nine_colored_deer_lotus.jpg', 'This stunning digital piece illustrates the legendary Nine-Colored Deer gracefully stepping on lotus flowers, representing the harmony between mythical creatures and nature in Dunhuang art. By combining computer-generated imagery with traditional symbolism, the artist creates a vivid representation that emphasizes the interconnectedness of all life. The use of color and composition invites viewers to appreciate the balance between the spiritual and natural worlds.', 0),
(18, 'Camel Caravan in the Desert', 'Digital Design', 'images/art_picture/camel_caravan_desert.jpg', 'A vibrant design depicting a caravan of camels traveling through the desert, this artwork captures the spirit of the Silk Road and the enduring connection between Dunhuang and ancient trade routes. Utilizing digital design techniques, the artist conveys movement and life within the landscape, illustrating the historical significance of trade and cultural exchange that has defined Dunhuang''s legacy as a crossroads of civilization.', 6),
(19, 'Ancient Tower of the Western Regions', 'Digital Design', 'images/art_picture/ancient_tower_west.jpg', 'This digital artwork portrays an ancient tower in the Western Regions, showcasing the architectural grandeur and cultural heritage that flourished along the Silk Road in Dunhuang''s history. Employing digital rendering techniques, the artist captures the intricate details of the tower''s design, emphasizing its historical importance as a symbol of strength and endurance. This piece serves as a visual narrative of the cultural exchanges that took place in this vibrant region.', 0),
(20, 'Demons in the Stone Caves', 'Sketch', 'images/art_picture/stone_cave_demons.jpg', 'This haunting sketch illustrates the powerful imagery of mythical demons as depicted in the Dunhuang cave murals. Through meticulous line work and shading, the artist captures the intense expressions and dynamic forms of these legendary figures, highlighting the dramatic storytelling inherent in Dunhuang art. The attention to detail showcases the skilled craftsmanship of traditional sketching, emphasizing the emotional depth and cultural significance of these ancient motifs.', 0),
(20, 'Mural Detail Reproduction', 'Sketch', 'images/art_picture/mural_detail_reproduction.jpg', 'An intricate oil painting that serves as a detailed reproduction of ancient mural art, this piece captures the vivid and delicate details found in Dunhuang''s cave paintings. The artist employs fine brushwork to replicate the texture and color of the original murals, showcasing the beauty of the art form while honoring its historical context. The reproduction not only preserves the intricate designs but also invites viewers to appreciate the narrative richness embedded within these ancient artworks.', 0),
(20, 'Flying Apsara with Fluttering Ribbons', 'Sketch', 'images/art_picture/fluttering_ribbons_flight.jpg', 'This delicate sketch of a Flying Apsara features graceful ribbons fluttering in the wind, exemplifying the elegance and dynamism characteristic of Dunhuang''s celestial beings. The artist skillfully uses linework to convey movement and fluidity, capturing the ethereal nature of the Apsara as she dances through the air. This piece highlights the beauty of sketching in its ability to evoke emotion and imagination, reflecting the joyous spirit of ancient performances.', 0),
(20, 'Flute Melody', 'Sketch', 'images/art_picture/flute_melody.jpg', 'A beautifully rendered sketch captures a musician playing the flute, bringing to life the Dunhuang music scene through intricate details and expressive lines. The artist focuses on the fluidity of the musician''s posture and the delicate features of the instrument, evoking the melodic tunes that resonated in ancient times. This work highlights the importance of music in Dunhuang culture and the role of artistic representation in preserving its legacy.', 15),
(20, 'Dunhuang Palace and Apsaras', 'Sketch', 'images/art_picture/dunhuang_palace_apsaras.jpg', 'This detailed sketch portrays the grandeur of a Dunhuang palace, complemented by the graceful presence of flying Apsaras hovering in the sky. The artist employs precise lines and careful shading to convey the architectural magnificence and the whimsical beauty of these celestial dancers. This piece serves as a tribute to the artistic mastery of Dunhuang, capturing the harmonious blend of human and divine elements that characterized its murals.', 11),
(22, 'Evolution of Apsara Forms', 'Sketch', 'images/art_picture/apsara_evolution.jpg', 'Exploring the transformation of Apsara forms over time, this sketch captures the shifting styles and poses of these celestial dancers as they evolved in Dunhuang art. Through careful observation and skillful line work, the artist delineates the subtle changes in attire and posture, offering insights into the cultural and artistic trends that influenced these beloved figures. This piece serves as a historical documentation of the Apsara''s evolution within the rich tapestry of Dunhuang''s artistic heritage.', 0),
(22, 'Noblewoman', 'Sketch', 'images/art_picture/noblewoman.jpg', 'A refined sketch of a noblewoman, this artwork reflects the grace and status of the aristocracy as depicted in Dunhuang murals. The artist''s attention to detail captures the elegance of her attire and features, embodying the ideals of beauty and refinement prevalent in ancient society. This sketch serves as a reminder of the cultural significance of noblewomen in the artistic narrative of Dunhuang, showcasing their roles in both life and art.', 0),
(22, 'Court Lady', 'Sketch', 'images/art_picture/court_lady.jpg', 'This sketch portrays a court lady with delicate features, symbolizing beauty and refinement. Drawing inspiration from the exquisite female figures in Dunhuang art, the artist employs precise lines and gentle shading to convey the elegance of her attire and demeanor. This piece celebrates the artistic representation of women in Dunhuang, emphasizing their importance within the cultural and social context of the time.', 8),
(23, 'The Splendor of the Western Pure Land', 'Sketch', 'images/art_picture/western_pure_land.jpg', 'Illustrating the grandeur of the Western Pure Land, this sketch depicts celestial beings gathering in celebration. The artist uses flowing lines and harmonious compositions to convey the spiritual richness and serenity of this Buddhist paradise. Through the intricate depiction of heavenly figures, the sketch invites viewers to contemplate the transcendent beauty of the Western Pure Land as portrayed in Dunhuang''s artistic tradition.', 1),
(24, 'Music and Dance Performance', 'Sketch', 'images/art_picture/music_dance_performance.jpg', 'This vibrant sketch captures a lively moment of musicians and dancers performing together, reflecting the joyful and festive spirit present in ancient Dunhuang. The artist skillfully employs dynamic lines to portray movement and interaction among the performers, evoking a sense of celebration. This piece encapsulates the cultural vibrancy of Dunhuang, showcasing the significance of music and dance in its rich artistic heritage.', 0);


-- 作品评论
INSERT INTO artwork_comment (user_id, artwork_id, content)
VALUES
(0004, 0001, 'This painting is so calming and serene! The use of soft colors really evokes a sense of peace and tranquility.'),
(0007, 0001, 'GOOD'),
(0002, 0019, 'beautiful!'),
(0031, 0003, 'I love it'),
(0030, 0003, 'beautiful work'),
(0023, 0013, 'Beautiful depiction of a majestic deer. The attention to detail truly brings the animal to life, making it feel almost real'),
(0007, 0007, 'I feel the energy in this artwork. It’s as if the colors are alive, radiating emotion and passion.'),
(0011, 0004, 'The design perfectly captures tranquility. It invites the viewer to pause and reflect, a true masterpiece.'),
(0017, 0004, 'really good creation'),
(0024, 0006, 'The details are breathtaking! Every brushstroke seems to tell a story, making this piece incredibly engaging.'),
(0022, 0016, 'wonderful!'),
(0019, 0035, 'I like it'),
(0011, 0038, 'That''s beautiful!'),
(0029, 0021, 'While I appreciate the concept of the Nine-Colored Deer’s Journey, I felt the execution lacked depth. It could have used more intricate details to enhance the storytelling aspect.'),
(0032, 0022, 'I love the idea behind New Wave of Dunhuang and Guochao, but the colors seem a bit overwhelming. A more balanced palette could have better represented the fusion of traditional and modern.'),
(0025, 0023, 'This piece feels a bit disconnected from the traditional Dunhuang style. I was expecting more harmony in the design elements'),
(0029, 0025, 'The Kingdom of Blessings has beautiful elements, but the overall composition feels cluttered. I believe a simpler design could convey the message more effectively.'),
(0019, 0025, 'i like it'),
(0021, 0026, 'The Carpet Design with Dunhuang Elements is colorful, but I think it misses the essence of traditional craftsmanship. It feels a bit too modern for my taste'),
(0002, 0027, 'I appreciate the lotus petal design. however, I expected it to convey more symbolism from Dunhuang’s history. It feels a bit generic.'),
(0012, 0029, 'I was disappointed with the Camel Caravan in the Desert. The composition lacks the grandeur typically associated with Dunhuang art, and it feels flat.'),
(0027, 0030, 'The Ancient Tower of the Western Regions has potential, but it doesn’t quite capture the architectural magnificence I was hoping for. The details seem rushed!'),
(0010, 0031, 'Demons in the Stone Caves had an interesting concept, but the execution could use improvement. The lines are too harsh, detracting from the mythical quality.');


-- 论坛评论
INSERT INTO discuss (forum_id, user_id, content)
VALUES
(0001, 26, 'I love your artworks! The way you depict serenity and peace in such vibrant colors is breathtaking'),
(0001, 30, 'The ‘Whispers of Apsara’ painting is one of my favorites. The composition and flow of the characters are perfect'),
(0006, 9, 'I admire how you capture the divine and mythical in your oil paintings. They resonate deeply with me'),
(0015, 9, 'Your blend of traditional and modern techniques is something I haven’t seen before. Keep up the amazing work!'),
(0009, 18, 'Your painting of the flying nymph is so ethereal, it feels like she''s about to dance off the canvas. Incredible detail!'),
(0016, 27, 'I appreciate how your artworks often tell stories. The level of depth and symbolism in each piece is astounding.'),
(0012, 31, 'I’ve always been fascinated by mythology, and your portrayal of these mythical scenes truly brings them to life. Amazing work!'),
(0005, 21, 'The connection between your art and the history of Dunhuang is truly remarkable. Thank you for sharing it.'),
(0022, 13, 'Every brushstroke tells a story; your works inspire me to explore my own creativity'),
(0002, 21, 'Your art is a breath of fresh air in today''s world. Keep inspiring us!'),
(0010, 12, 'The cultural significance in your work makes it all the more special. Thank you for this journey!'),
(0023, 25, 'I can''t wait to see more of your work. You have a unique perspective that shines through!'),
(0006, 9, 'What are the latest methods used to preserve the murals at Dunhuang? Are there modern digital techniques involved in the process?'),
(0001, 7, 'With the rise of digital tools, how do you think traditional art forms like those from Dunhuang can be integrated with modern digital designs?'),
(0002, 3, 'I am curious to know what everyone’s favorite Dunhuang-inspired artwork is and why it speaks to you. Let’s share and discuss!');


-- Milestone2

-- 创建商品表及订单表
CREATE TABLE product (
    product_id INT(4) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cover VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    intro TEXT,
    price INT NOT NULL
);


CREATE TABLE orders (
    order_id INT(5) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(4) ZEROFILL NOT NULL,
    total_price INT NOT NULL,
    address VARCHAR(200) NOT NULL,
    phone VARCHAR(11) NOT NULL,
    recipient VARCHAR(100) NOT NULL,
    status ENUM('Pending shipment', 'In transit', 'Delivered') NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);


CREATE TABLE order_detail (
    order_detail_id INT(5) ZEROFILL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(4) ZEROFILL NOT NULL,
    product_id INT(5) ZEROFILL NOT NULL,
    amount INT NOT NULL,
    ordered BOOLEAN DEFAULT false,
    order_id INT(5) ZEROFILL,

    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);


-- 商品
INSERT INTO product (name, cover, intro, price)
VALUES
('Qing Niao - Silk Scarf', 'images/product_picture/1.jpg', 'The "Qing Niao" silk scarf draws inspiration from the image of the blue bird in Dunhuang murals, crafted from high-quality silk with hand-dyed patterns, showcasing exquisite craftsmanship and unique design. Each scarf incorporates elements of Dunhuang culture, making it a fashionable daily accessory and a valuable collectible.', 199),
('Jiu Se Lu - Silk Scarf', 'images/product_picture/2.jpg', 'The "Jiu Se Lu" silk scarf is inspired by the nine-colored deer in Dunhuang murals, symbolizing peace and happiness. Made from eco-friendly dyes and natural silk, its vivid patterns and rich colors make it suitable for various occasions. This unique design combines traditional culture with modern fashion, reflecting elegance and cultural confidence.', 199),
('Tian Ma - Silk Scarf', 'images/product_picture/3.jpg', 'The "Tian Ma" silk scarf is inspired by the mystical heavenly horse in Dunhuang art, symbolizing freedom and hope. Made from high-quality silk, the hand-painted patterns highlight exquisite craftsmanship and artistic fluidity, suitable for pairing with different styles of clothing, serving as a neck accessory, headscarf, or bag decoration.', 199),
('Ling Long - Silk Scarf', 'images/product_picture/4.jpg', 'The "Ling Long" silk scarf incorporates the cultural symbol of the dragon in Dunhuang art, representing strength and good fortune. With elegant silk material and exquisite pattern design, the scarf embodies a perfect blend of traditional aesthetics and modern trends, suitable for various occasions, serving as a fashion accessory or a gift conveying blessings.', 199),
('Mogao Cave Academy - Series', 'images/product_picture/5.jpg', 'The "Mogao Cave Academy" series is specially written to interpret Dunhuang art, including topics like art history, mural analysis, and cultural background. This series gathers research achievements from various experts, aiming to comprehensively showcase the rich connotation and historical value of Dunhuang culture, making it an ideal choice for learning and researching Dunhuang art.', 268),
('Magical Dunhuang - Book Set', 'images/product_picture/6.jpg', 'The "Magical Dunhuang" book set includes several exquisite books and related cultural products, covering the history, art, and culture of Dunhuang. With its beautifully designed gift box, it reflects the mystery and charm of Dunhuang culture. Each book is accompanied by beautiful illustrations and detailed interpretations, allowing readers to deeply explore the artistic allure and cultural heritage of Dunhuang.', 99),
('Dunhuang Murals - Restoration', 'images/product_picture/7.jpg', 'The "Dunhuang Murals" restoration book focuses on the high-precision restoration and display of Dunhuang murals, featuring high-definition images and detailed analyses of classic murals, aiming to present the artistic style and historical context of Dunhuang murals. This restoration book is not only a precious resource for art enthusiasts but also a practical reference for learning about Dunhuang art, combining both appreciation and practicality.', 45),
('Dunhuang Art - Premium Album', 'images/product_picture/8.jpg', 'The "Dunhuang Art" premium album gathers masterpieces and treasures of Dunhuang art, with carefully selected illustrations showcasing the brilliant colors and intricate techniques of Dunhuang murals. Each album includes expert interpretations and background information, allowing readers to appreciate the art while delving into the deep cultural heritage of Dunhuang, making it an essential resource for art lovers and researchers.', 69),
('Chinese Grotto Art - Series', 'images/product_picture/9.jpg', 'The "Chinese Grotto Art" series systematically introduces the grotto art across China, centered around Mogao Grottoes, and includes the artistic achievements of famous sites like Yungang and Longmen. The content is rich, analyzing the evolution, craftsmanship, and cultural background of grotto art, serving as an authoritative reference for enthusiasts.', 98),
('Dunhuang Powder Sketches & Silk Flowers - Album', 'images/product_picture/10.jpg', 'The "Dunhuang Powder Sketches & Silk Flowers" album focuses on sketches (art creation drafts) and silk flowers, showcasing the unique craftsmanship and delicate beauty of Dunhuang painting art. Through high-definition reproductions and detailed annotations, it guides readers to appreciate the intricacies of Dunhuang artistic creation, suitable for art researchers and collectors.', 66),
('History of Dunhuang & Buddhist Culture - Book', 'images/product_picture/11.jpg', 'The "History of Dunhuang & Buddhist Culture" book delves into the historical evolution and cultural influence of Dunhuang as a center for Buddhist dissemination. It includes rich visual materials and archaeological findings, helping readers gain a comprehensive understanding of Dunhuang''s significant role in the development of Buddhist culture, making it a valuable resource for religious and historical research.', 86),
('Returning to Dunhuang - Book', 'images/product_picture/12.jpg', '"Returning to Dunhuang" focuses on the art, history, and culture of Dunhuang, covering its Buddhist murals, grotto architecture, and the faith stories behind them. The book presents the unique charm of Dunhuang as a place of faith in an accessible manner, appealing to general readers and enthusiasts of religious culture.', 158),
('Homecoming - Autobiography of Dean Fan Jinshi', 'images/product_picture/13.jpg', 'This autobiography of Ms. Fan Jinshi, former director of the Dunhuang Research Institute, recounts her years of dedication to Dunhuang studies and her life experiences. It shares her insights and achievements in art research, showcasing her deep love for Dunhuang art and her spirit of preservation, making it an inspiring and touching biographical work.', 158),
('Dunhuang Nine-Colored Deer - Paper Cutting Set', 'images/product_picture/14.jpg', 'The "Dunhuang Nine-Colored Deer" paper cutting set features designs inspired by the nine-colored deer in Dunhuang murals, recreating the lively posture of the deer through the traditional craft of paper cutting. Each set is handmade, making it suitable for art decoration or gifts, both ornamental and promoting traditional culture.', 39),
('Dunhuang Etiquette - Pillow', 'images/product_picture/15.jpg', 'The "Dunhuang Etiquette" pillow design features motifs of hand gestures and etiquette patterns from Dunhuang murals, made with soft, comfortable fabric that combines aesthetics and practicality. The design allows users to feel the warmth and beauty of Dunhuang culture in their daily lives, making it ideal for home decor or gifts.', 55),
('Embracing Nature - Tea Cup Set', 'images/product_picture/16.jpg', 'The "Embracing Nature" tea cup set draws inspiration from Dunhuang''s landscape murals, with mountain and water patterns on the cups that reflect serene natural beauty. The set includes multiple sizes of cups to cater to various tea-drinking needs, allowing users to feel as if they are immersed in the landscape paintings of Dunhuang, providing a unique cultural experience.', 88);


-- 用户订单信息
INSERT INTO orders (user_id, total_price, address, status, recipient, phone)
VALUES
(26, 398, 'Beijing University', 'Pending shipment', 'Alice', '18360025661'),
(27, 597, 'Shanghai Ocean University', 'In transit', 'John Doe', '18360025662'),
(28, 90, 'Wuhan University', 'Delivered', 'Zhang Wei', '18360025663'),
(29, 78, 'Tsinghua University', 'Pending shipment', 'Emma Li', '18360025664'),
(30, 157, 'Nanjing University', 'Delivered', 'Liu Bei', '18360025665');


-- 已下单的订单详细信息
INSERT INTO order_detail (order_id, product_id, amount, ordered, user_id)
VALUES
(1, 1, 2, true, 26),
(2, 3, 3, true, 27),
(3, 7, 2, true, 28),
(4, 14, 2, true, 29),
(5, 8, 1, true, 30),
(5, 16, 1, true, 30);

-- 未下单的购物车详细信息
INSERT INTO order_detail (product_id, amount, user_id)
VALUES
(1, 1, 29),
(2, 3, 23),
(10, 2, 30);
