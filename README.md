# php_thumb_mini
Simple PHP image thumbnail maker

phpThumb (http://phpthumb.sourceforge.net/) 프로그램과 동일한 기능을 합니다.
src, w, h, q, zc 옵션등 동일하게 사용 가능합니다.

아직 캐싱기능이 없어서 on the fly 로만 생성하며,
phpThumb 에는 없는 zoom crop top 기능을 추가했습니다.
사실 zoom crop top 기능이 필요해서 만들었습니다. (인물사진 세로형)

그리고 이미지 리사이즈를 하지 않는 noexpand 옵션도 있습니다.
이미지를 재처리 하지 않아도 되는 상황인데,
굳이 이미지가 확대되는 것을 방지할 수 있습니다.

