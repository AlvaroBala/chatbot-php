import sys
import json
from nltk.sentiment import SentimentIntensityAnalyzer

def analyze_sentiment(text):
    sia = SentimentIntensityAnalyzer()
    return sia.polarity_scores(text)

if __name__ == '__main__':
    input_text = sys.argv[1]
    analysis_result = analyze_sentiment(input_text)
    print(json.dumps(analysis_result))