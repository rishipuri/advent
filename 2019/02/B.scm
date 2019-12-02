(load "A.scm")

(define find-nounverb
  (lambda (codes stop)
    (let outer ((i 0))
      (unless (= i 100)
        (let inner ((j 0))
          (unless (= j 100)
            (cond
              ((= (run codes i j) stop) (print (+ (* i 100) j)))
              (else (inner (+ j 1))))))
        (outer (+ i 1))))))

(find-nounverb (fetch-input "input.txt") 19690720) ; 8226
