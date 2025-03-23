<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu - Daisy's Tea</title>
    <style>
        body {
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #eee4e1;
            color: #333;
        }

        .container1 {
            width: 80%;
            margin: auto;
            overflow: hidden;
            display: flex;
            padding: 20px;
            border-radius: 8px;
            background-color: #fefefe;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            text-align: center;
            margin-top: 0;
            color: #b2967d;
        }

        .content p {
            text-align: justify;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li strong {
            color: #b2967d;
        }

        .highlight {
            font-weight: bold;
            color: #27ae60;
        }

        .image-container {
            flex: 1;
            padding-left: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-container img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        .content {
            flex: 2;
            padding-right: 20px;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

    </style>
</head>
<body>
    <div class="container1">
        <div class="content">
            <h1>Giới Thiệu Daisy's Tea</h1>
            <p>
                Daisy's Tea không chỉ là một quán trà sữa thông thường, mà là nơi mang đến cho bạn những trải nghiệm ẩm thực tuyệt vời cùng không gian ấm cúng và hiện đại. Chúng tôi đặt tâm huyết vào từng chi tiết nhỏ nhất để đảm bảo rằng mỗi ly trà sữa đều đạt tiêu chuẩn cao nhất về chất lượng và hương vị. Nguyên liệu được chọn lọc kỹ lưỡng từ các nguồn uy tín, đảm bảo sự tươi ngon và an toàn cho sức khỏe.
            </p>
            <h2 class="highlight">Lý do nên chọn Daisy's Tea:</h2>
            <ul>
                <li><strong>Chất lượng hàng đầu:</strong> Sử dụng nguyên liệu tươi ngon, mỗi ly trà sữa tại Daisy's Tea đều có hương vị đậm đà và hấp dẫn.</li>
                <li><strong>Thực đơn đa dạng:</strong> Cung cấp nhiều lựa chọn từ trà sữa truyền thống đến trà trái cây, đáp ứng mọi sở thích của khách hàng.</li>
                <li><strong>Không gian ấm cúng:</strong> Quán mang đến không gian hiện đại, thân thiện, phù hợp cho mọi dịp gặp gỡ và thư giãn.</li>
                <li><strong>Dịch vụ tận tâm:</strong> Đội ngũ nhân viên luôn phục vụ chuyên nghiệp, nhanh chóng và chu đáo.</li>
                <li><strong>Giá cả hợp lý:</strong> Chất lượng cao với mức giá phải chăng, cùng nhiều chương trình khuyến mãi hấp dẫn.</li>
            </ul>
        </div>
        <div class="image-container">
            <img src="./pic/TràTráiCây/Trà Đào.jpg" alt="Daisy's Tea">
        </div>
    </div>
</body>
</html>