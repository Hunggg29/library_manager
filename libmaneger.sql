
CREATE DATABASE libmaneger;
USE libmaneger;

CREATE TABLE user_info (
    userinfo_id INT AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(255) UNIQUE NOT NULL,
    status BIT NOT NULL DEFAULT 1,
    PRIMARY KEY (userinfo_id)
);

CREATE TABLE nhanvien (
    nhanvien_id INT AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(255) UNIQUE NOT NULL,
    status BIT NOT NULL DEFAULT 1,
    PRIMARY KEY (nhanvien_id)
);

CREATE TABLE book (
    book_id INT AUTO_INCREMENT NOT NULL,
    book_name VARCHAR(255) UNIQUE NOT NULL,
    type VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    available INT NOT NULL,
    description TEXT NULL,
    PRIMARY KEY (book_id)
);

CREATE TABLE transaction (
    transaction_id INT AUTO_INCREMENT NOT NULL,
    userinfo_id INT NOT NULL,
    book_id INT NOT NULL,
    status BIT NOT NULL DEFAULT 0,
    PRIMARY KEY (transaction_id),
    FOREIGN KEY (userinfo_id) REFERENCES user_info(userinfo_id),
    FOREIGN KEY (book_id) REFERENCES book(book_id)
);

CREATE TABLE transaction_info (
    transaction_id INT NOT NULL,
    borrowdate DATE NOT NULL DEFAULT CURRENT_DATE,
    duedate DATE NOT NULL DEFAULT DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY),
    PRIMARY KEY (transaction_id),
    FOREIGN KEY (transaction_id) REFERENCES `transaction`(transaction_id)
);

CREATE TABLE returnbooks (
    transaction_id INT NOT NULL,
    nhanvien_id INT NOT NULL,
    returndate DATE NOT NULL DEFAULT CURRENT_DATE,
    fines INT NOT NULL DEFAULT 0,
    status BIT NOT NULL DEFAULT 1,
    PRIMARY KEY (transaction_id),
    FOREIGN KEY (transaction_id) REFERENCES `transaction`(transaction_id),
    FOREIGN KEY (nhanvien_id) REFERENCES nhanvien(nhanvien_id)
);

CREATE TABLE fines (
    fines_id INT AUTO_INCREMENT NOT NULL,
    userinfo_id INT NOT NULL,
    nhanvien_id INT NOT NULL,
    money INT NOT NULL,
    finesdate DATE DEFAULT CURRENT_DATE,
    PRIMARY KEY (fines_id),
    FOREIGN KEY (userinfo_id) REFERENCES user_info(userinfo_id),
    FOREIGN KEY (nhanvien_id) REFERENCES nhanvien(nhanvien_id)
);

INSERT INTO user_info(first_name,last_name,username,password,email,address,phone) values('Thanh','Duong','katanashi03','okebae123','katanashi03@gmail.com','78 197 Hoàng Mai','0329980119');

INSERT INTO user_info(first_name,last_name,username,password,email,address,phone) values('Văn','Thể','hthe1010','vanthe','hthe1010@gmail.com','Hai Bà Trưng, Hà Nội','0388019282');

INSERT INTO user_info(first_name,last_name,username,password,email,address,phone) values('Anh','Thái','anhthaingd','anhthai','anhthaingd@gmail.com','Cầu Giấy, Hà Nội','0622882279');

INSERT INTO nhanvien(first_name,last_name,username,password,email,address,phone) values('Thành','Tiến','ThanhDuong3103','okebae123','thanhtien31032002@gmail.com','78 197 Hoàng Mai','0329980119');

INSERT INTO book(book_name,type,author,available,description) 
values('Tôi tài giỏi, bạn cũng thế','Psychology','Adam Khoo',8,'Được sáng tác bởi một doanh nhân người Singapore tên Adam Khoo. Nội dung của cuốn sách là những chia sẻ về các câu chuyện cũng như phương pháp học tập. Do chính tác giả đã trải nghiệm khi mới ở độ tuổi cấp 2. Chính vì thế cuốn sách giúp cho người đọc có được sự tự tin cũng như ý thức tự lập tốt. Đồng thời làm chủ cho cuộc sống của chính mình. Đây được xem là một trong những cuốn sách nên đọc bởi nó đã được dịch ra với nhiều ngôn ngữ khác nhau và được truyền bá rộng rãi trên khắp thế giới.');

INSERT INTO book(book_name,type,author,available,description) 
values('Đắc nhân tâm','Psychology','Dale Carnegie',10,'Sách có nội dung đưa ra những lời khuyên rất bổ ích trong cách ứng xử. Cách đối nhân xử thế trong cuộc sống hàng ngày giúp cho người đọc hoàn thiện và vươn tới thành công. Chính vì thế bản thân mỗi người nên trang bị cho mình một cuốn sách. Thật sự, Đắc nhân tâm chính là nghệ thuật để thu hút lòng người cũng như thu phục được lòng người, bởi chính sự chân thành của độc giả qua lời văn và ngôn ngữ của tác giả.');


INSERT INTO book(book_name,type,author,available,description) 
values('Tội ác và trừng phạt','Psychology','Dostoevsky',8,'Đây là cuốn sách từng được bình chọn là cuốn sách vĩ đại nhất mọi thời đại, một trong những cuốn sách hay nên đọc. Tội ác và trừng trị có nội dung nói về luật nhân quả trong cuộc sống là một kiệt tác về tình yêu thương giữa con người với nhau. Trong cuộc sống để có thể hòa nhập, thân thiện với nhau. Gạt vỏ mọi thù hằn, và nói về các tội ác nếu đã thực hiện.');


INSERT INTO book(book_name,type,author,available,description) 
values('Nhà giả kim','Psychology','Paulo Coelho',18,'Nhà giả kim như là đang tự thuật trò chuyện với chính bản thân mình. Sách đã chỉ ra được những thứ đơn giản mà sâu sắc nhất trong đời, khi đọc sách mới có thể ngộ ra được. Bởi rất ít ai có thể tự mình nhận ra được điều đó. Trong tác phẩm đem đến cho độc giả sự lạc quan, những điều mơ ước mà con người đôi khi cũng chỉ biết mơ và không dám thực hiện. Quả thật nhà giả kim đã được biết đến trên khắp các nước trên thế giới. Đặc biệt còn được hầu hết các độc giả ở mọi lứa tuổi yêu thích và lựa chọn.');

INSERT INTO book(book_name,type,author,available,description) 
values('Mỗi lần vấp ngã là một lần Trưởng Thành','Psychology','Liêu Trí Phong',7,'Người ta vẫn thường hay nói mỗi lần vấp ngã là một lần đau và sau mỗi cú ngã ấy, chúng ta sẽ trở nên mạnh mẽ và trưởng thành hơn bao giờ hết. Cuộc sống đôi khi cũng có những ngày như thế đó. Thế nhưng, khi sự vấp ngã đã trở thành thói quen với một thân mình chằng chịt vết trầy xước, đó chính là khi tâm hồn dần dần hình thành sự vô cảm và chai sạm trước những nỗi đau.');

INSERT INTO book(book_name,type,author,available,description) 
values('Tuổi Trẻ Đáng Giá Bao Nhiêu?','Psychology','Rosie Nguyễn',7,'Bạn có chết mòn nơi xó tường với những ước mơ dang dở, đó không phải là việc của họ. Suy cho cùng, quyết định là ở bạn. Muốn có điều gì hay không là tùy bạn. Nên hãy làm những điều bạn thích. Hãy đi theo tiếng nói trái tim. Hãy sống theo cách bạn cho là mình nên sống.');

INSERT INTO book(book_name,type,author,available,description) 
values('Đời thay đổi khi chúng ta thay đổi','Psychology','Andrew Matthews',17,'“Đời thay đổi khi chúng ta thay đổi” (Being A Happy Teenager) đem lại cho độc giả những tình huống vô cùng thực tế, thậm chí là các câu chuyện vừa “nhỏ nhặt” lại vừa “quan trọng” với cách ứng xử khôn ngoan, thú vị và hài hước… Đồng thời, độc giả như bắt gặp chính mình trong đó, có những cạnh tranh, thất bại, và có những tình huống giao tiếp vừa chân thật lại vừa bổ ích.');

INSERT INTO book(book_name,type,author,available,description) 
values('Dạy Con Làm Giàu','Psychology','Robert Kiyosaki',17,'Cuốn sách Dạy Con Làm Giàu nói về cách làm sinh ra đồng tiền và quan điểm rất hay về đồng tiền., khơi dậy khả năng kiếm tiền của mỗi cá nhân.
Hai quan điểm khác nhau đó là: Tham tiền là một tội ác, còn người kia lại bảo Nghèo hèn là nguồn gốc của mọi tội ác. Bài học mà bạn đọc nhận được từ cuốn sách này đó là: Người giàu không làm việc vì tiền, bắt tiền làm việc cho mình. Hai nữa là nếu như bạn muon làm giàu phải có vốn kiến thức nền tảng cho mình như tài chính, thị trường, cung cầu… Nếu bạn hiểu được những vấn đề này, nội dung của sách sẽ được hấp thu dễ dàng và sâu sắc hơn.');

INSERT INTO book(book_name,type,author,available,description) 
values('Zen and the Art of Motorcycle Maintenance','Psychology','Robert M. Pirsig',12,'Viết về một hành trình đi khắp nước Mỹ trong mùa hè của một người cha và cậu con trai, cuốn sách Zen And The Art Of Motorcycle Maintenance còn là một hành trình triết học với đầy những câu hỏi cơ bản về cuộc sống và cách sống trên đời.

');



DELIMITER //
CREATE PROCEDURE getinfo_allacuser()
BEGIN
    
    SELECT 
        userinfo_id, 
        CONCAT(first_name, ' ', last_name) AS name,
        username,
        email,
        password,
        address,
        phone
    FROM user_info
    WHERE status = 1;
END //


    CREATE PROCEDURE getinfo_acuser(IN usernameinput VARCHAR(255))
    BEGIN
        SELECT 
            userinfo_id, 
            CONCAT(first_name, ' ', last_name) AS name, 
            email, 
            password, 
            address, 
            phone 
        FROM 
            user_info
        WHERE 
            status = 1 
            AND username = usernameinput;
    END //

CREATE PROCEDURE getinfo_allnhanvien()
BEGIN 
    SELECT 
        nhanvien_id,
        CONCAT(first_name, ' ', last_name) AS name,
        username,
        email,
        password,
        phone,
        address
    FROM
        nhanvien
    WHERE
        status = 1;
END // 

CREATE PROCEDURE getinfo_nhanvien(IN usernameinput VARCHAR(255))
BEGIN 
    SELECT 
        nhanvien_id,
        CONCAT(first_name, ' ', last_name) AS name,
        email,
        password,
        phone,
        address
    FROM nhanvien
    WHERE status = 1 AND username = usernameinput;
END // 

CREATE PROCEDURE getinfo_availablebook(IN searchParam VARCHAR(255))
BEGIN
    IF searchParam IS NULL OR searchParam = '' THEN
        SELECT * FROM book;
    ELSE
        SELECT * FROM book
        WHERE book_name LIKE CONCAT('%', searchParam, '%')
           OR type LIKE CONCAT('%', searchParam, '%')
           OR author LIKE CONCAT('%', searchParam, '%');
    END IF;
END //


CREATE PROCEDURE find_availablebookBytype(IN input_type varchar(255))
BEGIN 
    SELECT 
        book_id,
        book_name,
        type,
        author,
        available
    FROM book
    WHERE available > 0 AND (SELECT POSITION(input_type IN type) > 0);
END //


CREATE PROCEDURE find_transactionbyId(IN id INTEGER)
BEGIN
    SELECT 
        CONCAT(user_info.first_name, ' ', user_info.last_name) AS name,
        book.book_name,
        transaction_info.borrowDate AS borrowdate,
        transaction_info.dueDate AS duedate
    FROM 
        transaction
        INNER JOIN transaction_info ON transaction_info.transaction_id = transaction.transaction_id
        INNER JOIN user_info ON transaction.userinfo_id = user_info.userinfo_id
        INNER JOIN book ON book.book_id = transaction.book_id
    WHERE 
        user_info.status = 1 
        AND transaction.status = 0 
        AND id = transaction.userinfo_id;
END//


CREATE PROCEDURE findall_actransaction(
    IN search_param VARCHAR(255)
)
BEGIN
    SELECT 
        transaction.transaction_id,
        CONCAT(user_info.first_name, ' ', user_info.last_name) AS name,
        book.book_name,
        transaction_info.borrowDate AS borrowdate,
        transaction_info.dueDate AS duedate
    FROM 
        transaction
        INNER JOIN transaction_info ON transaction_info.transaction_id = transaction.transaction_id
        INNER JOIN user_info ON transaction.userinfo_id = user_info.userinfo_id
        INNER JOIN book ON book.book_id = transaction.book_id
    WHERE 
        user_info.status = 1 
        AND transaction.status = 0
        AND (
            search_param IS NULL 
            OR CONCAT(user_info.first_name, ' ', user_info.last_name) LIKE search_param
            OR book.book_name LIKE search_param
        );
END //

CREATE PROCEDURE findallreturned(IN search_term VARCHAR(255))
BEGIN
    IF search_term IS NULL OR search_term = '' THEN
    SELECT 
        transaction.transaction_id,
        user_info.userinfo_id,
        CONCAT(user_info.first_name, ' ', user_info.last_name) AS name,
        book.book_name,
        returnbooks.returndate,
        returnbooks.fines,
        nhanvien.username,
        returnbooks.status
    FROM 
        transaction
        INNER JOIN returnbooks ON returnbooks.transaction_id = transaction.transaction_id
        INNER JOIN user_info ON transaction.userinfo_id = user_info.userinfo_id
        INNER JOIN book ON book.book_id = transaction.book_id
        INNER JOIN nhanvien ON nhanvien.nhanvien_id = returnbooks.nhanvien_id
    WHERE
        transaction.status = 1
    ORDER BY 
        returnbooks.returndate DESC;
    ELSE
        SELECT 
        transaction.transaction_id,
        user_info.userinfo_id,
        CONCAT(user_info.first_name, ' ', user_info.last_name) AS name,
        book.book_name,
        returnbooks.returndate,
        returnbooks.fines,
        nhanvien.username,
        returnbooks.status
    FROM 
        transaction
        INNER JOIN returnbooks ON returnbooks.transaction_id = transaction.transaction_id
        INNER JOIN user_info ON transaction.userinfo_id = user_info.userinfo_id
        INNER JOIN book ON book.book_id = transaction.book_id
        INNER JOIN nhanvien ON nhanvien.nhanvien_id = returnbooks.nhanvien_id
    WHERE
        transaction.status = 1 AND 
        (book.book_name LIKE CONCAT('%', search_term, '%') OR search_term IS NULL)
    ORDER BY 
        returnbooks.returndate DESC;
        END IF;
END //

CREATE PROCEDURE findallfined(IN search_date DATE)
BEGIN
    IF search_date IS NULL OR search_date = '' THEN
    SELECT 
        CONCAT(user_info.first_name, ' ', user_info.last_name) AS name,
        user_info.username,
        nhanvien.username AS nhanvienusername,
        fines.money,
        fines.finesdate
    FROM 
        fines
        INNER JOIN user_info ON fines.userinfo_id = user_info.userinfo_id
        INNER JOIN nhanvien ON fines.nhanvien_id = nhanvien.nhanvien_id
    ORDER BY fines.finesdate DESC;
    ELSE 
    SELECT 
        CONCAT(user_info.first_name, ' ', user_info.last_name) AS name,
        user_info.username,
        nhanvien.username AS nhanvienusername,
        fines.money,
        fines.finesdate
    FROM 
        fines
        INNER JOIN user_info ON fines.userinfo_id = user_info.userinfo_id
        INNER JOIN nhanvien ON fines.nhanvien_id = nhanvien.nhanvien_id
    WHERE 
        fines.finesdate = search_date
    ORDER BY fines.finesdate DESC;
    END IF;
END//



CREATE TRIGGER add_transactionb
BEFORE INSERT ON transaction
FOR EACH ROW
BEGIN
    DECLARE available_count INT;
    DECLARE active_transactions INT;

    -- Check the availability of the book
    SELECT available INTO available_count FROM book WHERE book.book_id = NEW.book_id;

    -- Check the number of active transactions for the user
    SELECT COUNT(t.transaction_id)
    INTO active_transactions
    FROM user_info ui
    LEFT JOIN transaction t ON ui.userinfo_id = t.userinfo_id
    WHERE ui.status = 1 AND (t.status = 0 OR t.status IS NULL) AND ui.userinfo_id = NEW.userinfo_id
    GROUP BY ui.userinfo_id;

    IF available_count > 0 AND (active_transactions IS NULL OR active_transactions < 5) THEN
        -- Update the availability of the book
        UPDATE book SET available = available - 1 WHERE book.book_id = NEW.book_id;
    ELSE
        -- Prevent the insert by signaling an error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot add transaction: book unavailable or user has too many active transactions';
    END IF;
END//

CREATE TRIGGER add_transactiona
AFTER INSERT ON transaction
FOR EACH ROW
BEGIN
    DECLARE available_count INT;
    DECLARE user_status BOOLEAN;

    -- Check the availability of the book
    SELECT available INTO available_count FROM book WHERE book.book_id = NEW.book_id;

    -- Check the status of the user
    SELECT status INTO user_status FROM user_info WHERE user_info.userinfo_id = NEW.userinfo_id;

    IF available_count > 0 AND user_status = 1 THEN
        -- Insert into transaction_info
        INSERT INTO transaction_info(transaction_id) VALUES (NEW.transaction_id);
    ELSE
        -- Prevent the insert by signaling an error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot add transaction information: book unavailable or user status is not active';
    END IF;
END//

CREATE TRIGGER return_books
BEFORE INSERT ON returnbooks
FOR EACH ROW
BEGIN
    DECLARE due_date DATE;
    DECLARE overdue_days INT;
    DECLARE user_id INT;
    DECLARE fine_amount INT DEFAULT 0;
    DECLARE return_status TINYINT DEFAULT 1;

    -- Get the due date of the book
    SELECT duedate INTO due_date 
    FROM transaction_info 
    WHERE transaction_id = NEW.transaction_id;

    -- Calculate overdue days
    SET overdue_days = DATEDIFF(NEW.returndate, due_date);

    IF overdue_days > 0 THEN
        -- Calculate fines
        SET fine_amount = overdue_days * 3000;

        -- Get the user ID
        SELECT userinfo_id INTO user_id 
        FROM transaction 
        WHERE transaction_id = NEW.transaction_id;

        -- Update user status
        UPDATE user_info 
        SET status = 0 
        WHERE userinfo_id = user_id;

        -- Set return status
        SET return_status = 0;
    END IF;

    -- Update fines and status in the NEW record
    SET NEW.fines = fine_amount;
    SET NEW.status = return_status;

    -- Update transaction status
    UPDATE transaction 
    SET status = 1 
    WHERE transaction_id = NEW.transaction_id;

    -- Update book availability
    UPDATE book 
    SET available = available + 1 
    WHERE book_id = (SELECT book_id 
                     FROM transaction 
                     WHERE transaction_id = NEW.transaction_id);
END//

CREATE TRIGGER check_fines
AFTER INSERT ON fines
FOR EACH ROW
BEGIN
    DECLARE total_fines INT;
    DECLARE total_paid INT;
    
    -- Calculate total fines for the user
    SELECT SUM(fines) INTO total_fines
    FROM returnbooks
    INNER JOIN transaction ON returnbooks.transaction_id = transaction.transaction_id
    WHERE transaction.userinfo_id = NEW.userinfo_id
    GROUP BY transaction.userinfo_id;

    -- Calculate total money paid by the user
    SELECT SUM(money) INTO total_paid
    FROM fines
    WHERE fines.userinfo_id = NEW.userinfo_id
    GROUP BY fines.userinfo_id;

    -- Check if the total paid is greater than or equal to total fines
    IF total_paid >= total_fines THEN
        -- Update user status to TRUE (active)
        UPDATE user_info
        SET status = 1
        WHERE user_info.userinfo_id = NEW.userinfo_id;
    END IF;
END//
DELIMITER ;




-- test of insert a transaction
-- INSERT INTO transaction(userinfo_id,book_id) values (1,1);
-- INSERT INTO transaction(userinfo_id,book_id) values (2,3);
-- INSERT INTO transaction(userinfo_id,book_id) values (2,2);
-- test returnbooks 
-- INSERT INTO returnbooks(transaction_id,nhanvien_id) values (1,1);
-- check fines 
-- INSERT INTO returnbooks(transaction_id,nhanvien_id,returndate) values (39,1,'2022-08-06');
-- CHECK pay the fines to active account INSERT INTO fines(nhanvien_id,userinfo_id,money) values (1,12,48000);
