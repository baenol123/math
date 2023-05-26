<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // 파일의 원래 이름
        $filename = $_FILES['photo']['name'];

        // 파일의 임시 저장 경로
        $tmpFilePath = $_FILES['photo']['tmp_name'];

        // 파일을 저장할 디렉토리 경로
        $uploadDir = './uploads/';

        // 디렉토리가 없으면 생성
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // 저장할 파일 경로
        $filePath = $uploadDir . $filename;

        // 파일 이동
        if (move_uploaded_file($tmpFilePath, $filePath)) {
            // 파일 업로드 성공 메시지
            echo '파일이 성공적으로 업로드되었습니다.';
        } else {
            // 파일 업로드 실패 메시지
            echo '파일 업로드에 실패했습니다.';
        }
    } else {
        // 파일 업로드 실패 메시지
        echo '파일 업로드에 실패했습니다.';
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');
    echo '405 Method Not Allowed';
}
?>
