<?php
class Chopper {
    private $haystack = NULL;
    private $numElems = 0;
    private $shifted = 0;
    private $availableKeys = NULL;
    
    public function chopIterative($needle, $haystack) {
        // iterate
        foreach ($haystack as $key => $value) {
            if ($needle === $value) {
                // here it is
                return $key;
            }
        }
        // not found
        return -1;
    }

    // $haystack could be passed by reference, would it be better?
    public function chopRecursive($needle, $haystack) {
        if ($this->haystack === NULL) {
            $this->haystack = $haystack;
            $this->numElems = count($this->haystack);
        }

        $currentKey  = key($this->haystack);
        $curentValue = current($this->haystack);

        if ($curentValue === $needle) {
            // we've found that sucker, return its value
            return $currentKey;
        }
        
        if ($currentKey=== $this->numElems - 1) {
            // we ran out of elements - quit with -1
            return -1;
        }

        // naaah, nothing, next one please
        next($this->haystack);
        return $this->chopRecursive($needle, $this->haystack);
    }

    // IDGTS - why should this perform better???
    public function chopSlice($needle, $haystack) {
        $elemsHaystack      = count($haystack);
        $haystackLower      = array_slice($haystack, 0, $elemsHaystack / 2);
        $haystackUpper      = array_slice($haystack, $elemsHaystack / 2, $elemsHaystack);
        $elemsHaystackLower = count($haystackLower);

        // iterate lower slice
        foreach ($haystackLower as $key => $value) {
            if ($needle === $value) {
                // here it is
                return $key;
            }
        }
        // iterate upper slice
        foreach ($haystackUpper as $key => $value) {
            if ($needle === $value) {
                // add num count for lower array to return correct key for full array
                return $elemsHaystackLower + $key;
            }
        }

        // nothing found
        return -1;
    }

    // search from both sides via array_shift / array_pop
    public function chopFirstLastPop($needle, $haystack) {
        $this->haystack = $haystack;
        $this->shifted  = 0;
        $this->numElems = count($this->haystack);

        for ($i=0; $i < $this->numElems; $i++) {
            if ($i & 1) {
		end ($this->haystack);
                $elemsKey     = key($this->haystack);
                $currentValue = array_pop($this->haystack);

                if ($needle === $currentValue) {
                    return $elemsKey + $this->shifted;
                }

            } else {
                reset ($this->haystack);
                $currentValue = array_shift($this->haystack);

                if ($needle === $currentValue) {
                    return $this->shifted;
                }
                
	        $this->shifted++;
            }
        }
        return -1;
    }

    // get available keys, mix them up and try until running out of keys
    public function chopRandom($needle, $haystack) {
        $this->haystack = $haystack;
        $flippedHaystack = array_flip($haystack);
        shuffle($flippedHaystack);
        $this->availableKeys = $flippedHaystack;

        foreach ($this->availableKeys as $haystackKey) {
             if ($needle === $this->haystack[$haystackKey]) {
                 return $haystackKey;
             }
             unset($this->haystack[$haystackKey], $this->availableKeys[$haystackKey]);
        }
        return -1;
    }

}
?>