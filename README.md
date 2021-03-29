
## Mount S3 drive
s3fs www.cma-livingstones.org /mnt/s3-drive -o use_cache=/tmp -o allow_other -o uid=1001 -o mp_umask=002 -o multireq_max=5 -o use_path_request_style -o url=https://s3-ap-southeast-1.amazonaws.com